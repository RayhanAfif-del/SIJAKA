<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin,mitra,alumni')->group(function () {
    $alumniMitraLoginPath = config('app.admin_login_path', 'panel-sijaka');
    if ($alumniMitraLoginPath !== 'panel-sijaka') {
        Route::get($alumniMitraLoginPath, [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post($alumniMitraLoginPath, [AuthenticatedSessionController::class, 'store']);
        Route::get('panel-sijaka', [AuthenticatedSessionController::class, 'create']);
        Route::post('panel-sijaka', [AuthenticatedSessionController::class, 'store']);
    } else {
        Route::get('panel-sijaka', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('panel-sijaka', [AuthenticatedSessionController::class, 'store']);
    }
    if ($alumniMitraLoginPath !== 'login') {
        Route::get('login', [AuthenticatedSessionController::class, 'create']);
        Route::post('login', [AuthenticatedSessionController::class, 'store']);
    }
});

// Panel Admin (support both pane-admin-sijaka and panel-admin-sijaka)
Route::middleware('guest:admin')->group(function () {
    $adminLoginPath = config('app.admin_panel_login_path', 'pane-admin-sijaka');
    if ($adminLoginPath !== 'pane-admin-sijaka' && $adminLoginPath !== 'panel-admin-sijaka') {
        Route::get($adminLoginPath, [AuthenticatedSessionController::class, 'createAdmin'])->name('admin.login');
        Route::post($adminLoginPath, [AuthenticatedSessionController::class, 'storeAdmin']);
    } else {
        Route::get($adminLoginPath, [AuthenticatedSessionController::class, 'createAdmin'])->name('admin.login');
        Route::post($adminLoginPath, [AuthenticatedSessionController::class, 'storeAdmin']);
    }
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
    Route::match(['get', 'head'], '/oauth/redirect', [\App\Http\Controllers\OAuthController::class, 'redirect'])->name('oauth.redirect');
    Route::match(['get', 'head'], '/sipintu/redirect', [\App\Http\Controllers\OAuthController::class, 'redirect'])->name('sipintu.redirect');
    Route::match(['get', 'head'], '/oauth/callback', [\App\Http\Controllers\OAuthController::class, 'callback'])->name('oauth.callback');
});

// Route callback SSO aliases untuk pengujian probe dari SiPintu Gateway
Route::match(['get', 'post', 'head'], '/callback', [\App\Http\Controllers\OAuthController::class, 'callback']);
Route::match(['get', 'post', 'head'], '/sipintu/callback', [\App\Http\Controllers\OAuthController::class, 'callback']);

Route::middleware('auth:admin,mitra,alumni')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::post('admin/logout', [AuthenticatedSessionController::class, 'destroyAdmin'])->name('admin.logout');
    Route::post('mitra/logout', [AuthenticatedSessionController::class, 'destroyMitra'])->name('mitra.logout');
    Route::post('alumni/logout', [AuthenticatedSessionController::class, 'destroyAlumni'])->name('alumni.logout');
});
