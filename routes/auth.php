<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\SipintuController;
use Illuminate\Support\Facades\Route;

$alumniMitraLoginPath = config('auth.admin_login_path', 'panel-sijaka');
$adminLoginPath = config('auth.admin_panel_login_path', 'pane-admin-sijaka');

// Panel Alumni & Mitra
Route::middleware('guest:mitra,alumni')->group(function () use ($alumniMitraLoginPath) {
    Route::get($alumniMitraLoginPath, [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post($alumniMitraLoginPath, [AuthenticatedSessionController::class, 'store']);
    if ($alumniMitraLoginPath !== 'panel-sijaka') {
        Route::get('panel-sijaka', [AuthenticatedSessionController::class, 'create']);
        Route::post('panel-sijaka', [AuthenticatedSessionController::class, 'store']);
    }
});

// Panel Admin (support both pane-admin-sijaka and panel-admin-sijaka)
Route::middleware('guest:admin')->group(function () use ($adminLoginPath) {
    Route::get($adminLoginPath, [AuthenticatedSessionController::class, 'createAdmin'])->name('admin.login');
    Route::post($adminLoginPath, [AuthenticatedSessionController::class, 'storeAdmin']);

    if ($adminLoginPath !== 'pane-admin-sijaka') {
        Route::get('pane-admin-sijaka', [AuthenticatedSessionController::class, 'createAdmin']);
        Route::post('pane-admin-sijaka', [AuthenticatedSessionController::class, 'storeAdmin']);
    }
    if ($adminLoginPath !== 'panel-admin-sijaka') {
        Route::get('panel-admin-sijaka', [AuthenticatedSessionController::class, 'createAdmin']);
        Route::post('panel-admin-sijaka', [AuthenticatedSessionController::class, 'storeAdmin']);
    }
});

Route::middleware('guest:admin,mitra,alumni')->group(function () {
    Route::match(['get', 'head'], '/oauth/redirect', [SipintuController::class, 'redirect'])->name('sipintu.redirect');
});

// Route callback SSO harus dapat diakses publik tanpa pembatasan guest middleware
// dan mendukung GET, POST, serta HEAD untuk pengujian probe dari SiPintu Gateway
Route::match(['get', 'post', 'head'], '/oauth/callback', [SipintuController::class, 'callback'])->name('sipintu.callback');
Route::match(['get', 'post', 'head'], '/callback', [SipintuController::class, 'callback']);
Route::match(['get', 'post', 'head'], '/sipintu/callback', [SipintuController::class, 'callback']);

Route::middleware('auth:admin,mitra,alumni')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::post('admin/logout', [AuthenticatedSessionController::class, 'destroyAdmin'])->name('admin.logout');
    Route::post('mitra/logout', [AuthenticatedSessionController::class, 'destroyMitra'])->name('mitra.logout');
    Route::post('alumni/logout', [AuthenticatedSessionController::class, 'destroyAlumni'])->name('alumni.logout');
});
