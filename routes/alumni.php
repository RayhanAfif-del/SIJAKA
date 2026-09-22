<?php

use App\Http\Controllers\Alumni\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:alumni')->prefix('alumni')->name('alumni.')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'edit'])->name('dashboard');
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/dokumen/cv/unduh', [ProfileController::class, 'downloadCv'])->name('cv.download');
    Route::get('/dokumen/portfolio/unduh', [ProfileController::class, 'downloadPortfolio'])->name('portfolio.download');
    Route::get('/dokumen/{document}', [ProfileController::class, 'download'])->name('document.download');
});
