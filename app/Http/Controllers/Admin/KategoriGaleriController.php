<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\KategoriGaleri;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KategoriGaleriController extends Controller
{
    /**
     * Menampilkan daftar kategori galeri.
     */
    public function index(Request $request): View
    {
        $query = KategoriGaleri::withCount('galeri')->orderBy('nama');

        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->input('cari') . '%');
        }

        $kategori = $query->paginate(12)->withQueryString();

        return view('admin.kategori-galeri.index', compact('kategori'));
    }

    /**
     * Menyimpan kategori galeri baru.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100', 'unique:kategori_galeri,nama'],
            'deskripsi' => ['nullable', 'string', 'max:255'],
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.unique' => 'Kategori dengan nama ini sudah ada.',
            'nama.max' => 'Nama kategori maksimal 100 karakter.',
        ]);

        $kategori = KategoriGaleri::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => "Kategori '{$kategori->nama}' berhasil ditambahkan.",
                'data' => $kategori,
            ]);
        }

        return redirect()->route('admin.kategori-galeri.index')
            ->with('status', "Kategori '{$kategori->nama}' berhasil ditambahkan.");
    }

    /**
     * Memperbarui data kategori galeri.
     */
    public function update(Request $request, KategoriGaleri $kategoriGaleri): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100', 'unique:kategori_galeri,nama,' . $kategoriGaleri->id],
            'deskripsi' => ['nullable', 'string', 'max:255'],
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.unique' => 'Nama kategori ini sudah digunakan.',
            'nama.max' => 'Nama kategori maksimal 100 karakter.',
        ]);

        $oldNama = $kategoriGaleri->nama;
        $kategoriGaleri->update($validated);

        // Jika nama kategori berubah, sinkronkan foto galeri yang menggunakan nama lama
        if ($oldNama !== $validated['nama']) {
            Galeri::where('kategori', $oldNama)->update(['kategori' => $validated['nama']]);
        }

        return redirect()->route('admin.kategori-galeri.index')
            ->with('status', "Kategori '{$kategoriGaleri->nama}' berhasil diperbarui.");
    }

    /**
     * Menghapus kategori galeri.
     */
    public function destroy(KategoriGaleri $kategoriGaleri): RedirectResponse
    {
        $count = Galeri::where('kategori', $kategoriGaleri->nama)->count();

        if ($count > 0) {
            return back()->with(
                'error',
                "Kategori '{$kategoriGaleri->nama}' tidak dapat dihapus karena masih digunakan oleh {$count} foto kegiatan. Silakan ubah kategori foto terkait terlebih dahulu."
            );
        }

        $nama = $kategoriGaleri->nama;
        $kategoriGaleri->delete();

        return back()->with('status', "Kategori '{$nama}' berhasil dihapus.");
    }
}
