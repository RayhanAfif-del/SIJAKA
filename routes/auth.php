<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\SipintuController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin,mitra')->group(function () {
    Route::get(config('auth.admin_login_path'), [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post(config('auth.admin_login_path'), [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('guest:admin,mitra,alumni')->group(function () {
    Route::get('/oauth/redirect', [SipintuController::class, 'redirect'])->name('sipintu.redirect');
    Route::get('/oauth/callback', [SipintuController::class, 'callback'])->name('sipintu.callback');
});

Route::middleware('auth:admin,mitra,alumni')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
