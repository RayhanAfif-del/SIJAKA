<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GaleriRequest;
use App\Models\Galeri;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Menampilkan daftar galeri dengan fitur pencarian dan filter kategori.
     */
    public function index()
    {
        $query = Galeri::latest('tanggal');

        // Filter pencarian berdasarkan judul
        if (request('cari')) {
            $query->where('judul', 'like', '%' . request('cari') . '%');
        }

        // Filter berdasarkan kategori
        if (request('kategori')) {
            $query->where('kategori', request('kategori'));
        }

        return view('admin.galeri.index', [
            'galeri' => $query->paginate(12),
        ]);
    }

    /**
     * Menampilkan form tambah foto galeri.
     */
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Menyimpan foto galeri baru.
     */
    public function store(GaleriRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['foto'] = $request->file('foto')->store('galeri', 'public');

        Galeri::create($data);

        return redirect()->route('admin.galeri.index')->with('status', 'Foto berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit foto galeri.
     */
    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * Mengupdate data foto galeri.
     */
    public function update(GaleriRequest $request, Galeri $galeri): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($galeri->foto);
            $data['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('status', 'Foto berhasil diperbarui.');
    }

    /**
     * Menghapus foto galeri.
     */
    public function destroy(Galeri $galeri): RedirectResponse
    {
        Storage::disk('public')->delete($galeri->foto);
        $galeri->delete();

        return back()->with('status', 'Foto berhasil dihapus.');
    }
}