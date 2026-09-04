<?php

use App\Http\Controllers\Public\ArtikelController;
use App\Http\Controllers\Public\BerandaController;
use App\Http\Controllers\Public\GaleriController;
use App\Http\Controllers\Public\KontakController;
use App\Http\Controllers\Public\LowonganController;
use App\Http\Controllers\Public\ProfilController;
use App\Http\Controllers\Public\StatistikController;
use App\Http\Controllers\Public\StrukturOrganisasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('home');

Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('struktur-organisasi.index');

Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
Route::get('/lowongan/{lowongan}', [LowonganController::class, 'show'])->name('lowongan.show');

Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{artikel}', [ArtikelController::class, 'show'])->name('artikel.show');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');

Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');

require __DIR__.'/auth.php';
require __DIR__.'/alumni.php';
require __DIR__.'/admin.php';
require __DIR__.'/mitra.php';
