<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function __construct(
        private PaymentService $paymentService
    ) {}

    public function yooKassa(Request $request): JsonResponse
    {
        $data = $request->all();

        Log::info('YooKassa webhook received', ['data' => $data]);

        // Verify payload
        if (!$this->paymentService->verifyWebhookPayload($data)) {
            Log::warning('Webhook verification failed', ['data' => $data]);
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        // Handle webhook
        $success = $this->paymentService->handleWebhook($data);

        if ($success) {
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Processing failed'], 500);
    }
}
