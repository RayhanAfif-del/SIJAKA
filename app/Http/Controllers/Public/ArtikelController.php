<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $keyword = trim((string) $request->input('cari', ''));

        $artikel = Artikel::when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('judul', 'like', "%{$keyword}%")
                        ->orWhere('kategori', 'like', "%{$keyword}%")
                        ->orWhere('konten', 'like', "%{$keyword}%");
                });
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('public.artikel.index', compact('artikel'));
    }

    public function show(Artikel $artikel)
    {
        return view('public.artikel.show', compact('artikel'));
    }
}
