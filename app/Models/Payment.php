<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'type',
        'amount',
        'status',
        'external_payment_id',
        'related_id',
        'metadata',
        'idempotency_key',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'metadata' => 'array',
    ];

    public function letter(): BelongsTo
    {
        return $this->belongsTo(Letter::class, 'related_id');
    }

    public function prediction(): BelongsTo
    {
        return $this->belongsTo(Prediction::class, 'related_id');
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }
}
