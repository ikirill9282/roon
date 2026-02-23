<?php

namespace App\Services;

use App\Models\Prediction;
use App\Models\FreeOpen;
use Illuminate\Support\Facades\Log;

class PredictionService
{
    public function getRandomPrediction(string $category): ?Prediction
    {
        return Prediction::active()
            ->byCategory($category)
            ->inRandomOrder()
            ->first();
    }

    public function hasUsedFreeOpen(string $deviceUuid, string $category): bool
    {
        return FreeOpen::where('device_uuid', $deviceUuid)
            ->where('category', $category)
            ->exists();
    }

    public function markFreeOpenUsed(string $deviceUuid, string $category): FreeOpen
    {
        return FreeOpen::create([
            'device_uuid' => $deviceUuid,
            'category' => $category,
            'used_at' => now(),
        ]);
    }

    public function getPredictionForUser(string $deviceUuid, string $category, bool $isFree = false): Prediction
    {
        if ($isFree && !$this->hasUsedFreeOpen($deviceUuid, $category)) {
            $this->markFreeOpenUsed($deviceUuid, $category);
            Log::info('Free open used', ['device_uuid' => $deviceUuid, 'category' => $category]);
        }

        $prediction = $this->getRandomPrediction($category);

        if (!$prediction) {
            throw new \Exception("No active predictions found for category: {$category}");
        }

        return $prediction;
    }

    public function getPaidPrediction(string $category): Prediction
    {
        // Get random prediction for paid opens (no free-open check)
        $prediction = $this->getRandomPrediction($category);

        if (!$prediction) {
            throw new \Exception("No active predictions found for category: {$category}");
        }

        return $prediction;
    }
}
