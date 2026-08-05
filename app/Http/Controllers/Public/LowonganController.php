<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index(Request $request)
    {
        $lowongan = Lowongan::disetujui()
            ->with('mitra')
            ->when($request->filled('cari'), function ($query) use ($request) {
                $keyword = $request->input('cari');
                $query->where(function ($q) use ($keyword) {
                    $q->where('posisi', 'like', "%{$keyword}%")
                        ->orWhereHas('mitra', fn ($m) => $m->where('nama_perusahaan', 'like', "%{$keyword}%"));
                });
            })
            ->when($request->filled('lokasi'), function ($query) use ($request) {
                $query->where('lokasi', $request->input('lokasi'));
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        // Untuk isi dropdown filter lokasi
        $daftarLokasi = Lowongan::disetujui()->distinct()->pluck('lokasi');

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
