<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StrukturOrganisasiRequest;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        return view('admin.struktur-organisasi.index', [
            'struktur' => StrukturOrganisasi::all(),
        ]);
    }

    public function create()
    {
        return view('admin.struktur-organisasi.create');
    }

    public function store(StrukturOrganisasiRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        StrukturOrganisasi::create($data);

        return redirect()->route('admin.struktur-organisasi.index')->with('status', 'Data berhasil ditambahkan.');
    }

    public function edit(StrukturOrganisasi $strukturOrganisasi)
    {
        return view('admin.struktur-organisasi.edit', compact('strukturOrganisasi'));
    }

    public function update(StrukturOrganisasiRequest $request, StrukturOrganisasi $strukturOrganisasi): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($strukturOrganisasi->foto) {
                Storage::disk('public')->delete($strukturOrganisasi->foto);
            }
            $data['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        $strukturOrganisasi->update($data);

        return redirect()->route('admin.struktur-organisasi.index')->with('status', 'Data berhasil diperbarui.');
    }

    public function destroy(StrukturOrganisasi $strukturOrganisasi): RedirectResponse
    {
        if ($strukturOrganisasi->foto) {
            Storage::disk('public')->delete($strukturOrganisasi->foto);
        }

        $strukturOrganisasi->delete();

        return back()->with('status', 'Data berhasil dihapus.');
    }
}
