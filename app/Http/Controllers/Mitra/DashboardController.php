<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $mitra = Auth::guard('mitra')->user();

        $lowongan = $mitra->lowongan();

        // Grafik "Lowongan Saya" 7 hari terakhir
        $grafik = (clone $lowongan)
            ->selectRaw('DATE(created_at) as tanggal, count(*) as total')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->pluck('total', 'tanggal');

        return view('mitra.dashboard.index', [
            'totalLowongan' => (clone $lowongan)->count(),
            'menunggu' => (clone $lowongan)->menunggu()->count(),
            'disetujui' => (clone $lowongan)->disetujui()->count(),
            'ditolak' => (clone $lowongan)->where('status', 'ditolak')->count(),
            'lowonganTerbaru' => (clone $lowongan)->latest()->take(4)->get(),
            'grafik' => $grafik,
        ]);
    }
}
