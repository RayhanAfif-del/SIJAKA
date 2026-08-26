<?php

use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\LowonganController;
use App\Http\Controllers\Admin\MitraController;
use App\Http\Controllers\Admin\PengaturanBerandaController;
use App\Http\Controllers\Admin\ProfilBkkController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/website', fn () => redirect()->route('home'))->name('website');

    // Singleton: profil BKK & kontak hanya edit, tidak ada create/delete
    Route::get('/profil-bkk', [ProfilBkkController::class, 'edit'])->name('profil-bkk.edit');
    Route::put('/profil-bkk', [ProfilBkkController::class, 'update'])->name('profil-bkk.update');

    Route::resource('struktur-organisasi', StrukturOrganisasiController::class)->except(['show']);

    Route::resource('mitra', MitraController::class);
    Route::post('/mitra/{mitra}/reset-password', [MitraController::class, 'resetPassword'])->name('mitra.reset-password');

    Route::resource('lowongan', LowonganController::class)->only(['index', 'edit', 'update', 'destroy']);
    Route::patch('/lowongan/{lowongan}/approve', [LowonganController::class, 'approve'])->name('lowongan.approve');
    Route::patch('/lowongan/{lowongan}/reject', [LowonganController::class, 'reject'])->name('lowongan.reject');

    Route::resource('artikel', ArtikelController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('alumni', AlumniController::class);

    Route::get('/pengaturan/beranda', [PengaturanBerandaController::class, 'edit'])->name('pengaturan-beranda.edit');
    Route::put('/pengaturan/beranda', [PengaturanBerandaController::class, 'update'])->name('pengaturan-beranda.update');

    Route::get('/kontak', [KontakController::class, 'edit'])->name('kontak.edit');
    Route::put('/kontak', [KontakController::class, 'update'])->name('kontak.update');
});
