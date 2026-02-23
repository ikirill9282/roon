<?php

namespace App\Services;

use App\Models\Payment;
use YooKassa\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentService
{
    private Client $yooKassaClient;

    public function __construct()
    {
        $this->yooKassaClient = new Client();
        $shopId = config('yookassa.shop_id');
        $secretKey = config('yookassa.secret_key');
        if ($shopId && $secretKey) {
            $this->yooKassaClient->setAuth((int) $shopId, $secretKey);
        }
    }

    public function createPayment(string $type, float $amount, int $relatedId, ?string $category = null, ?string $idempotencyKey = null): Payment
    {
        $idempotencyKey = $idempotencyKey ?? $this->generateIdempotencyKey($type, $relatedId);

        // Check if payment with this idempotency key already exists
        $existingPayment = Payment::where('idempotency_key', $idempotencyKey)->first();
        if ($existingPayment) {
            Log::warning('Duplicate payment attempt prevented', ['idempotency_key' => $idempotencyKey]);
            return $existingPayment;
        }

        return Payment::create([
            'type' => $type,
            'amount' => $amount,
            'status' => 'pending',
            'related_id' => $relatedId,
            'metadata' => $category ? ['category' => $category] : null,
            'idempotency_key' => $idempotencyKey,
        ]);
    }

    public function initiateYooKassaPayment(Payment $payment): string
    {
        $description = $payment->type === 'letter' 
            ? 'Отправка цифрового послания'
            : 'Открытие предсказания';

        $paymentData = [
            'amount' => [
                'value' => number_format($payment->amount, 2, '.', ''),
                'currency' => 'RUB',
            ],
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => route('payment.success'),
            ],
            'description' => $description,
            'metadata' => array_merge([
                'payment_id' => $payment->id,
                'type' => $payment->type,
            ], $payment->metadata ?? []),
        ];

        try {
            $idempotencyKey = $payment->idempotency_key ?? $this->generateIdempotencyKey($payment->type, $payment->related_id);
            
            $yooKassaPayment = $this->yooKassaClient->createPayment(
                $paymentData,
                $idempotencyKey
            );

            $payment->update([
                'external_payment_id' => $yooKassaPayment->getId(),
            ]);

            Log::info('YooKassa payment created', [
                'payment_id' => $payment->id,
                'external_id' => $yooKassaPayment->getId(),
            ]);

            return $yooKassaPayment->getConfirmation()->getConfirmationUrl();
        } catch (\Exception $e) {
            Log::error('YooKassa payment creation failed', [
                'payment_id' => $payment->id,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    public function handleWebhook(array $data): bool
    {
        $externalPaymentId = $data['object']['id'] ?? null;
        $status = $data['object']['status'] ?? null;
        $amount = $data['object']['amount']['value'] ?? null;

        if (!$externalPaymentId || !$status) {
            Log::warning('Invalid webhook data', ['data' => $data]);
            return false;
        }

        return $this->updatePaymentStatus($externalPaymentId, $status, $amount);
    }

    public function verifyWebhookPayload(array $data): bool
    {
        $externalPaymentId = $data['object']['id'] ?? null;
        $amount = $data['object']['amount']['value'] ?? null;
        $status = $data['object']['status'] ?? null;

        if (!$externalPaymentId) {
            return false;
        }

        $payment = Payment::where('external_payment_id', $externalPaymentId)->first();

        if (!$payment) {
            Log::warning('Payment not found for webhook', ['external_id' => $externalPaymentId]);
            return false;
        }

        // Verify amount matches
        if ($amount && abs((float)$amount - (float)$payment->amount) > 0.01) {
            Log::warning('Payment amount mismatch', [
                'expected' => $payment->amount,
                'received' => $amount,
            ]);
            return false;
        }

        return true;
    }

    public function updatePaymentStatus(string $externalId, string $status, ?float $amount = null): bool
    {
        $payment = Payment::where('external_payment_id', $externalId)->first();

        if (!$payment) {
            Log::warning('Payment not found', ['external_id' => $externalId]);
            return false;
        }

        // Idempotency check: if already processed, return success
        if ($payment->status === 'paid' && $status === 'succeeded') {
            Log::info('Payment already processed', ['payment_id' => $payment->id]);
            return true;
        }

        // Update status
        $payment->update(['status' => $this->mapYooKassaStatus($status)]);

        // Update related entities
        if ($payment->status === 'paid') {
            if ($payment->type === 'letter') {
                $letter = \App\Models\Letter::find($payment->related_id);
                if ($letter) {
                    app(LetterService::class)->markAsPaid($letter);
                }
            }
            // For predictions, the prediction is shown after payment via frontend
            // The payment is created with related_id=0 and category in metadata
        }

        Log::info('Payment status updated', [
            'payment_id' => $payment->id,
            'status' => $payment->status,
        ]);

        return true;
    }

    public function generateIdempotencyKey(string $type, int $relatedId): string
    {
        return Str::uuid()->toString() . '-' . $type . '-' . $relatedId;
    }

    private function mapYooKassaStatus(string $yooKassaStatus): string
    {
        return match ($yooKassaStatus) {
            'succeeded' => 'paid',
            'canceled' => 'failed',
            default => 'pending',
        };
    }
}
