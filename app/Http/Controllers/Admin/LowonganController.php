<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index(Request $request)
    {
        $lowongan = Lowongan::with('mitra')
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->input('status')))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.lowongan.index', compact('lowongan'));
    }

    public function edit(Lowongan $lowongan)
    {
        return view('admin.lowongan.edit', compact('lowongan'));
    }

    public function update(Request $request, Lowongan $lowongan): RedirectResponse
    {
        $validated = $request->validate([
            'posisi' => ['required', 'string', 'max:150'],
            'lokasi' => ['required', 'string', 'max:150'],
            'unggulan' => ['boolean'],
        ]);
        $validated['unggulan'] = $request->boolean('unggulan');

        $lowongan->update($validated);

        return redirect()->route('admin.lowongan.index')->with('status', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(Lowongan $lowongan): RedirectResponse
    {
        $lowongan->delete();

        return back()->with('status', 'Lowongan berhasil dihapus.');
    }

    // Fitur "Approve Lowongan"
    public function approve(Lowongan $lowongan): RedirectResponse
    {
        $lowongan->update(['status' => 'disetujui']);

        return back()->with('status', "Lowongan \"{$lowongan->posisi}\" disetujui dan kini tampil di website.");
    }

    // Fitur "Reject Lowongan"
    public function reject(Lowongan $lowongan): RedirectResponse
    {
        $lowongan->update(['status' => 'ditolak']);

        return back()->with('status', "Lowongan \"{$lowongan->posisi}\" ditolak.");
    }
}
