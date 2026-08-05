<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Artikel;
use App\Models\Kontak;
use App\Models\Lowongan;
use App\Models\Mitra;
use App\Models\ProfilBkk;

class BerandaController extends Controller
{
    public function index()
    {
        return view('public.beranda.index', [
            'profilBkk' => ProfilBkk::singleton(),
            'mitra' => Mitra::latest()->take(8)->get(),
            'lowonganUnggulan' => Lowongan::disetujui()->unggulan()->latest()->take(3)->get(),
            'lowonganTerbaru' => Lowongan::disetujui()->latest()->take(3)->get(),
            'artikelTerbaru' => Artikel::latest()->take(3)->get(),
            'kontak' => Kontak::singleton(),
'alumniBekerja' => Alumni::bekerja()->count(),
            'alumniMelanjutkanStudi' => Alumni::melanjutkanStudi()->count(),
            'alumniBelumBekerja' => Alumni::belumBekerja()->count(),
        ]);
    }
}
