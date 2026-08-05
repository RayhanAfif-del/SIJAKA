<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $galeri = Galeri::when($request->filled('kategori'), function ($query) use ($request) {
                $query->where('kategori', $request->input('kategori'));
            })
            ->latest('tanggal')
            ->paginate(8)
            ->withQueryString();

        $kategoriList = Galeri::distinct()->pluck('kategori');

        return view('public.galeri.index', compact('galeri', 'kategoriList'));
    }
}
