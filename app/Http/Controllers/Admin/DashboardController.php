<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Artikel;
use App\Models\Lowongan;
use App\Models\Mitra;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalMitra' => Mitra::count(),
            'totalLowongan' => Lowongan::count(),
            'totalArtikel' => Artikel::count(),
            'totalAlumni' => Alumni::count(),

'alumniBekerja' => Alumni::bekerja()->count(),
            'alumniMelanjutkanStudi' => Alumni::melanjutkanStudi()->count(),
            'alumniBelumBekerja' => Alumni::belumBekerja()->count(),

            'lowonganMenunggu' => Lowongan::menunggu()->with('mitra')->latest()->take(5)->get(),

            'lowonganByStatus' => Lowongan::selectRaw('status, count(*) as total')
                ->groupBy('status')
                ->pluck('total', 'status'),

            'topLowongan' => Lowongan::with('mitra')
                ->orderByDesc('jumlah_kunjungan')
                ->take(5)
                ->get(),
        ]);
    }
}
