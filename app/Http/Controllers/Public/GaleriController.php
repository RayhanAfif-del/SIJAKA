<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Support\GaleriStack;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::query()
            ->when($request->filled('kategori'), function ($query) use ($request) {
                $query->where('kategori', $request->input('kategori'));
            })
            ->latest('tanggal')
            ->latest('id');

        $totalFoto = (clone $query)->count();
        $galeri = GaleriStack::paginate(
            GaleriStack::group((clone $query)->get()),
            8
        )->withQueryString();

        $kategoriList = Galeri::distinct()->pluck('kategori');

        return view('public.galeri.index', compact('galeri', 'kategoriList', 'totalFoto'));
    }
}
