<?php

use App\Http\Controllers\Alumni\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:alumni')->prefix('alumni')->name('alumni.')->group(function () {
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/dokumen/{document}', [ProfileController::class, 'download'])->name('document.download');
    Route::patch('/permintaan-wawancara/{interviewRequest}/{status}', [ProfileController::class, 'respond'])->name('interview.respond');
});
