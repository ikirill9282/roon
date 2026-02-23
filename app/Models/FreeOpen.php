<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreeOpen extends Model
{
    protected $fillable = [
        'device_uuid',
        'category',
        'used_at',
    ];

    protected $casts = [
        'used_at' => 'datetime',
    ];
}
