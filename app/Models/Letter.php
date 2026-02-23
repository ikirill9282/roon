<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Letter extends Model
{
    protected $fillable = [
        'message',
        'payment_status',
    ];

    protected $casts = [
        'payment_status' => 'string',
    ];

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'related_id');
    }
}
