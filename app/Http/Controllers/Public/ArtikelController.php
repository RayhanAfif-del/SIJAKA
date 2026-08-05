<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $artikel = Artikel::when($request->filled('cari'), function ($query) use ($request) {
                $query->where('judul', 'like', '%'.$request->input('cari').'%');
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
