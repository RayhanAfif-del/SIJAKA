<?php

use App\Http\Controllers\Alumni\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('alumni')->name('alumni.')->group(function () {
    Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
        if (\Illuminate\Support\Facades\Auth::guard('alumni')->check()) {
            return app(ProfileController::class)->edit($request);
        }

        if (\Illuminate\Support\Facades\Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        if (\Illuminate\Support\Facades\Auth::guard('mitra')->check()) {
            return redirect()->route('mitra.dashboard');
        }

        return redirect()->route('home')->with('info', 'Halaman dashboard alumni hanya dapat diakses oleh alumni yang telah lulus.');
    })->name('dashboard');

    Route::middleware('auth:alumni')->group(function () {
        Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/dokumen/cv/lihat', [ProfileController::class, 'viewCv'])->name('cv.view');
        Route::get('/dokumen/cv/unduh', [ProfileController::class, 'downloadCv'])->name('cv.download');
        Route::get('/dokumen/portfolio/lihat', [ProfileController::class, 'viewPortfolio'])->name('portfolio.view');
        Route::get('/dokumen/portfolio/unduh', [ProfileController::class, 'downloadPortfolio'])->name('portfolio.download');
        Route::get('/dokumen/{document}', [ProfileController::class, 'download'])->name('document.download');
    });
});
