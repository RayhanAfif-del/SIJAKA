<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GaleriRequest;
use App\Models\Galeri;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        return view('admin.galeri.index', [
            'galeri' => Galeri::latest('tanggal')->paginate(12),
        ]);
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(GaleriRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['foto'] = $request->file('foto')->store('galeri', 'public');

        Galeri::create($data);

        return redirect()->route('admin.galeri.index')->with('status', 'Foto berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

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

    public function destroy(Galeri $galeri): RedirectResponse
    {
        Storage::disk('public')->delete($galeri->foto);
        $galeri->delete();

        return back()->with('status', 'Foto berhasil dihapus.');
    }
}
