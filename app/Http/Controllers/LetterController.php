<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLetterRequest;
use App\Services\LetterService;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class LetterController extends Controller
{
    public function __construct(
        private LetterService $letterService,
        private PaymentService $paymentService
    ) {}

    public function store(StoreLetterRequest $request): JsonResponse
    {
        try {
            $letter = $this->letterService->createLetter($request->validated()['message']);
            
            $amount = config('pricing.letter');
            $payment = $this->paymentService->createPayment(
                'letter',
                $amount,
                $letter->id
            );
            
            $this->letterService->linkPaymentToLetter($letter, $payment);
            
            $paymentUrl = $this->paymentService->initiateYooKassaPayment($payment);
            
            Log::info('Letter created and payment initiated', [
                'letter_id' => $letter->id,
                'payment_id' => $payment->id,
            ]);
            
            return response()->json([
                'success' => true,
                'payment_url' => $paymentUrl,
                'message' => 'Письмо создано. Перенаправление на оплату...',
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create letter', [
                'error' => $e->getMessage(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка при создании письма',
            ], 500);
        }
    }
}
