<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpenPredictionRequest;
use App\Services\PredictionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PredictionController extends Controller
{
    public function __construct(
        private PredictionService $predictionService
    ) {}

    public function open(OpenPredictionRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $category = $validated['category'];
        $deviceUuid = $validated['device_uuid'];

        // Check if free open is available
        $hasUsedFreeOpen = $this->predictionService->hasUsedFreeOpen($deviceUuid, $category);

        if (!$hasUsedFreeOpen) {
            // Free open
            $prediction = $this->predictionService->getPredictionForUser($deviceUuid, $category, true);
            
            return response()->json([
                'success' => true,
                'free' => true,
                'prediction' => [
                    'id' => $prediction->id,
                    'content' => $prediction->content,
                    'category' => $prediction->category,
                ],
            ]);
        }

        // Paid open - return payment required
        $amount = config("pricing.prediction.{$category}");
        
        return response()->json([
            'success' => false,
            'free' => false,
            'payment_required' => true,
            'amount' => $amount,
            'category' => $category,
            'message' => 'Ты уже открыл бесплатный свёрток. Хочешь открыть ещё?',
        ]);
    }

    public function openPaid(OpenPredictionRequest $request): JsonResponse
    {
        // This endpoint is called after successful payment
        // It bypasses free-open check and returns a random prediction
        $validated = $request->validated();
        $category = $validated['category'];

        try {
            $prediction = $this->predictionService->getPaidPrediction($category);
            
            Log::info('Paid prediction opened', [
                'prediction_id' => $prediction->id,
                'category' => $category,
            ]);
            
            return response()->json([
                'success' => true,
                'free' => false,
                'prediction' => [
                    'id' => $prediction->id,
                    'content' => $prediction->content,
                    'category' => $prediction->category,
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to open paid prediction', [
                'category' => $category,
                'error' => $e->getMessage(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
