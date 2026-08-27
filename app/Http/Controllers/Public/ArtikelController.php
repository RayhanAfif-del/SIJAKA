<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $keyword = trim((string) $request->input('cari', ''));
        $page = max(1, (int) $request->input('page', 1));

        $query = Artikel::when($keyword !== '', function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                    ->orWhere('kategori', 'like', "%{$keyword}%")
                    ->orWhere('konten', 'like', "%{$keyword}%");
            });
        })->latest();

        $totalArtikel = (clone $query)->count();

        $limit = $page === 1 ? 7 : 6;
        $offset = $page === 1 ? 0 : 7 + (($page - 2) * 6);

        $items = (clone $query)
            ->skip($offset)
            ->take($limit)
            ->get();

        $artikel = new LengthAwarePaginator(
            $items,
            max($totalArtikel - 1, 0),
            6,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('public.artikel.index', compact('artikel', 'totalArtikel'));
    }

    public function show(Artikel $artikel)
    {
        return view('public.artikel.show', compact('artikel'));
    }
}
