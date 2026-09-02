<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Artikel;
use App\Models\Kontak;
use App\Models\Galeri;
use App\Models\Lowongan;
use App\Models\PengaturanWebsite;
use App\Models\Mitra;
use App\Models\ProfilBkk;
use App\Support\GaleriStack;

class BerandaController extends Controller
{
    public function index()
    {
        return view('public.beranda.index', [
            'profilBkk' => ProfilBkk::singleton(),
            'pengaturanWebsite' => PengaturanWebsite::singleton(),
            'mitra' => Mitra::latest()->take(8)->get(),
            'lowonganUnggulan' => Lowongan::disetujui()->unggulan()->latest()->take(3)->get(),
            'lowonganTerbaru' => Lowongan::disetujui()->latest()->take(4)->get(),
            'artikelTerbaru' => Artikel::latest()->take(3)->get(),
            'galeri' => GaleriStack::group(
                Galeri::latest('tanggal')->latest('id')->take(24)->get()
            )->take(5)->values(),
            'kontak' => Kontak::singleton(),
            'alumniBekerja' => Alumni::bekerja()->count() + Alumni::belumBekerja()->count(),
            'alumniBerwirausaha' => Alumni::berwirausaha()->count(),
            'alumniMelanjutkanStudi' => Alumni::melanjutkanStudi()->count(),
        ]);
    }
}
