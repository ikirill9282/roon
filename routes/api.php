<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

Route::post('/webhooks/yookassa', [WebhookController::class, 'yooKassa'])
    ->withoutMiddleware(['csrf'])
    ->middleware('throttle.webhook')
    ->name('webhooks.yookassa');
