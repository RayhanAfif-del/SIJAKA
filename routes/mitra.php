<?php

use App\Http\Controllers\Mitra\DashboardController;
use App\Http\Controllers\Mitra\LowonganController;
use App\Http\Controllers\Mitra\ProfilController;
use App\Http\Controllers\Mitra\TalentPoolController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:mitra')->prefix('mitra')->name('mitra.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

    Route::get('/talent-pool', [TalentPoolController::class, 'index'])->name('talent-pool.index');
    Route::post('/talent-pool/{alumni}/permintaan-wawancara', [TalentPoolController::class, 'requestInterview'])->name('talent-pool.request');
    Route::get('/permintaan-wawancara', [TalentPoolController::class, 'requests'])->name('interview-requests.index');
    Route::get('/talent-pool/{alumni}/dokumen/{document}', [TalentPoolController::class, 'download'])->name('talent-pool.document');

    // Policy LowonganPolicy otomatis dicek lewat authorizeResource
    Route::resource('lowongan', LowonganController::class)->except(['show']);
});
