<?php

namespace App\Services;

use App\Models\Letter;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class LetterService
{
    public function createLetter(string $message): Letter
    {
        return Letter::create([
            'message' => $message,
            'payment_status' => 'pending',
        ]);
    }

    public function linkPaymentToLetter(Letter $letter, Payment $payment): void
    {
        $payment->update([
            'related_id' => $letter->id,
            'type' => 'letter',
        ]);
    }

    public function markAsPaid(Letter $letter): void
    {
        $letter->update(['payment_status' => 'paid']);
        Log::info('Letter marked as paid', ['letter_id' => $letter->id]);
    }
}
