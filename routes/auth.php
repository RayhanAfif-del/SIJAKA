<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin,mitra')->group(function () {
    Route::get(config('auth.admin_login_path'), [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post(config('auth.admin_login_path'), [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:admin,mitra')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
