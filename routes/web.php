<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\PaymentController;

// Main page
Route::get('/', fn() => view('home'))->name('home');

// Static pages
Route::get('/privacy', fn() => view('privacy'))->name('privacy');
Route::get('/terms', fn() => view('terms'))->name('terms');
Route::get('/data-policy', fn() => view('data-policy'))->name('data-policy');

// Letter submission
Route::post('/api/letters', [LetterController::class, 'store'])->name('letters.store');

// Prediction opening
Route::post('/api/predictions/open', [PredictionController::class, 'open'])->name('predictions.open');
Route::post('/api/predictions/open-paid', [PredictionController::class, 'openPaid'])->name('predictions.open-paid');

// Payment creation
Route::post('/api/payments/create', [PaymentController::class, 'create'])->name('payments.create');

// Payment callbacks
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/failure', [PaymentController::class, 'failure'])->name('payment.failure');
