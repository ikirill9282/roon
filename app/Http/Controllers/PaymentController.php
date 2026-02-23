<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct(
        private PaymentService $paymentService
    ) {}

    public function create(CreatePaymentRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $type = $validated['type'];
            $relatedId = $validated['related_id'];
            $category = $validated['category'] ?? null;
            $idempotencyKey = $validated['idempotency_key'] ?? null;

            $amount = $type === 'letter' 
                ? config('pricing.letter')
                : config("pricing.prediction.{$category}");

            $payment = $this->paymentService->createPayment(
                $type,
                $amount,
                $relatedId,
                $category,
                $idempotencyKey
            );

            $paymentUrl = $this->paymentService->initiateYooKassaPayment($payment);

            Log::info('Payment created', [
                'payment_id' => $payment->id,
                'type' => $type,
                'amount' => $amount,
            ]);

            return response()->json([
                'success' => true,
                'payment_url' => $paymentUrl,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create payment', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка при создании платежа',
            ], 500);
        }
    }

    public function success(Request $request): RedirectResponse
    {
        // After successful payment, redirect to home
        // For predictions, the prediction will be shown via JavaScript after payment
        // Category is stored in sessionStorage by frontend before redirect
        return redirect('/?payment_success=1');
    }

    public function failure(Request $request): RedirectResponse
    {
        return redirect('/')->with('payment_failed', true);
    }
}
