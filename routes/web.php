<?php

use App\Http\Controllers\Public\ArtikelController;
use App\Http\Controllers\Public\BerandaController;
use App\Http\Controllers\Public\GaleriController;
use App\Http\Controllers\Public\KontakController;
use App\Http\Controllers\Public\LowonganController;
use App\Http\Controllers\Public\ProfilController;
use App\Http\Controllers\Public\StatistikController;
use App\Http\Controllers\Public\StrukturOrganisasiController;
use App\Http\Controllers\Public\TalentaController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'head'], '/', function (\Illuminate\Http\Request $request) {
    if ($request->wantsJson() || $request->isJson() || $request->has('ping') || $request->has('health')) {
        return response()->json([
            'status' => 'ok',
            'healthy' => true,
            'app' => config('app.name', 'SIJAKA'),
            'service' => 'sijaka-downstream',
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    return app(BerandaController::class)->index();
})->name('home');

Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('struktur-organisasi.index');

Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
Route::redirect('/daftar-lowongan', '/lowongan')->name('lowongan');
Route::get('/lowongan/{lowongan}', [LowonganController::class, 'show'])->name('lowongan.show');

Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{artikel}', [ArtikelController::class, 'show'])->name('artikel.show');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');
Route::get('/talenta', [TalentaController::class, 'index'])->name('talenta.index');
Route::get('/talenta/{alumni}/dokumen/{document}/view', [TalentaController::class, 'viewDocument'])->name('talenta.document.view');
Route::get('/talenta/{alumni}/dokumen/{document}/download', [TalentaController::class, 'downloadDocument'])->name('talenta.document.download');
Route::get('/talenta/{alumni}/dokumen/{document}', [TalentaController::class, 'downloadDocument'])->name('talenta.document');
Route::get('/talenta/{alumni}', [TalentaController::class, 'show'])->name('talenta.show');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');

// Route sentral /dashboard yang mengarahkan user sesuai perannya
Route::get('/dashboard', function () {
    return match (true) {
        \Illuminate\Support\Facades\Auth::guard('admin')->check() => redirect()->route('admin.dashboard'),
        \Illuminate\Support\Facades\Auth::guard('mitra')->check() => redirect()->route('mitra.dashboard'),
        \Illuminate\Support\Facades\Auth::guard('alumni')->check() => redirect()->route('alumni.dashboard'),
        default => redirect()->route('login'),
    };
})->name('dashboard');

// Endpoint pemantauan health check downstream untuk SiPintu (/health)
Route::match(['get', 'head'], '/health', [\App\Http\Controllers\OAuthController::class, 'health'])->name('health');
Route::match(['get', 'post'], '/sipintu/sync-user', [\App\Http\Controllers\OAuthController::class, 'syncUser']);
Route::match(['get', 'post'], '/sipintu/sync-password', [\App\Http\Controllers\OAuthController::class, 'syncPassword']);
Route::match(['get', 'post'], '/sipintu/ping', [\App\Http\Controllers\OAuthController::class, 'health']);

require __DIR__.'/auth.php';
require __DIR__.'/alumni.php';
require __DIR__.'/admin.php';
require __DIR__.'/mitra.php';
