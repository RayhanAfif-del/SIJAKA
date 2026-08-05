<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mitra\LowonganRequest;
use App\Models\Lowongan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongan = Auth::guard('mitra')->user()
            ->lowongan()
            ->latest()
            ->paginate(10);

        return view('mitra.lowongan.index', compact('lowongan'));
    }

    public function create()
    {
        return view('mitra.lowongan.create');
    }

    public function store(LowonganRequest $request): RedirectResponse
    {
        $mitra = Auth::guard('mitra')->user();

        $mitra->lowongan()->create([
            ...$request->validated(),
            // status selalu 'menunggu' saat dibuat mitra — hanya admin yang bisa mengubahnya
            'status' => 'menunggu',
            'unggulan' => false,
        ]);

        return redirect()->route('mitra.lowongan.index')
            ->with('status', 'Lowongan berhasil dibuat dan menunggu persetujuan admin.');
    }

    public function edit(Lowongan $lowongan)
    {
        $this->authorize('update', $lowongan);

        return view('mitra.lowongan.edit', compact('lowongan'));
    }

    public function update(LowonganRequest $request, Lowongan $lowongan): RedirectResponse
    {
        $this->authorize('update', $lowongan);

        // Perubahan data mengembalikan status ke 'menunggu' agar direview ulang admin
        $lowongan->update([
            ...$request->validated(),
            'status' => 'menunggu',
        ]);

        return redirect()->route('mitra.lowongan.index')
            ->with('status', 'Lowongan berhasil diperbarui dan menunggu persetujuan ulang.');
    }

    public function destroy(Lowongan $lowongan): RedirectResponse
    {
        $this->authorize('delete', $lowongan);

        $lowongan->delete();

        return back()->with('status', 'Lowongan berhasil dihapus.');
    }
}
