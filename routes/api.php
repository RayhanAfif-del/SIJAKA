<?php

use App\Http\Controllers\Api\SijunaController;
use App\Http\Controllers\Api\SipintuWebhookController;
use Illuminate\Support\Facades\Route;

// Health check endpoint (for /api/health)
Route::match(['get', 'head'], '/health', [SipintuWebhookController::class, 'health'])->name('api.health');

// SiPintu Webhook routes (/api/sipintu/sync-user, /api/sipintu/sync-password)
Route::prefix('sipintu')->group(function () {
    Route::match(['get', 'post'], '/sync-user', [SipintuWebhookController::class, 'syncUser'])->name('api.sipintu.sync-user');
    Route::match(['get', 'post'], '/sync-password', [SipintuWebhookController::class, 'syncPassword'])->name('api.sipintu.sync-password');
    Route::match(['get', 'post'], '/ping', [SipintuWebhookController::class, 'health'])->name('api.sipintu.ping');
});

// Fallback jika pemanggil menambahkan /api/ dua kali (/api/api/sipintu/...)
Route::prefix('api/sipintu')->group(function () {
    Route::match(['get', 'post'], '/sync-user', [SipintuWebhookController::class, 'syncUser']);
    Route::match(['get', 'post'], '/sync-password', [SipintuWebhookController::class, 'syncPassword']);
});

Route::middleware('auth:admin')->prefix('sijuna')->group(function () {
    Route::get('/students', [SijunaController::class, 'students'])->name('api.sijuna.students');
    Route::get('/teachers', [SijunaController::class, 'teachers'])->name('api.sijuna.teachers');
});