<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index(Request $request)
    {
        $keyword = trim((string) $request->input('cari', ''));
        $lokasi = trim((string) $request->input('lokasi', ''));

        $lowongan = Lowongan::disetujui()
            ->with('mitra')
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('posisi', 'like', "%{$keyword}%")
                        ->orWhere('lokasi', 'like', "%{$keyword}%")
                        ->orWhere('jenis_pekerjaan', 'like', "%{$keyword}%")
                        ->orWhereHas('mitra', fn ($m) => $m->where('nama_perusahaan', 'like', "%{$keyword}%"));
                });
            })
            ->when($lokasi !== '', function ($query) use ($lokasi) {
                $query->where('lokasi', $lokasi);
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        // Untuk isi dropdown filter lokasi
        $daftarLokasi = Lowongan::disetujui()
            ->whereNotNull('lokasi')
            ->distinct()
            ->orderBy('lokasi')
            ->pluck('lokasi');

        return view('public.lowongan.index', compact('lowongan', 'daftarLokasi'));
    }

    public function show(Lowongan $lowongan)
    {
        abort_unless($lowongan->status === 'disetujui', 404);

        $lowongan->load('mitra');
        $lowongan->tambahKunjungan();

        $lowonganLainnya = Lowongan::disetujui()
            ->where('id', '!=', $lowongan->id)
            ->latest()
            ->take(3)
            ->get();

        return view('public.lowongan.show', compact('lowongan', 'lowonganLainnya'));
    }
}
