<?php

use App\Http\Controllers\Mitra\DashboardController;
use App\Http\Controllers\Mitra\LowonganController;
use App\Http\Controllers\Mitra\ProfilController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:mitra')->prefix('mitra')->name('mitra.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

    // Policy LowonganPolicy otomatis dicek lewat authorizeResource
    Route::resource('lowongan', LowonganController::class)->except(['show']);
});
