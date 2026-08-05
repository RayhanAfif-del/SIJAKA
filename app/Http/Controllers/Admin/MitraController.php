<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MitraRequest;
use App\Models\Mitra;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MitraController extends Controller
{
    public function index()
    {
        return view('admin.mitra.index', [
            'mitra' => Mitra::withCount('lowongan')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.mitra.create');
    }

    // Admin membuat akun mitra baru (fitur "Membuat akun Mitra")
    public function store(MitraRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = $data['password']; // di-hash otomatis via cast di model

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('mitra', 'public');
        }

        Mitra::create($data);

        return redirect()->route('admin.mitra.index')->with('status', 'Akun mitra berhasil dibuat.');
    }

    public function edit(Mitra $mitra)
    {
        return view('admin.mitra.edit', compact('mitra'));
    }

    public function update(MitraRequest $request, Mitra $mitra): RedirectResponse
    {
        $data = $request->validated();

        // Jangan timpa password kalau field dikosongkan saat edit
        if (empty($data['password'])) {
            unset($data['password']);
        }

        if ($request->hasFile('logo')) {
            if ($mitra->logo) {
                Storage::disk('public')->delete($mitra->logo);
            }
            $data['logo'] = $request->file('logo')->store('mitra', 'public');
        }

        $mitra->update($data);

        return redirect()->route('admin.mitra.index')->with('status', 'Data mitra berhasil diperbarui.');
    }

    public function destroy(Mitra $mitra): RedirectResponse
    {
        if ($mitra->logo) {
            Storage::disk('public')->delete($mitra->logo);
        }

        $mitra->delete();

        return back()->with('status', 'Akun mitra berhasil dihapus.');
    }

    // Fitur "Reset Password Mitra": admin generate password acak baru
    public function resetPassword(Mitra $mitra): RedirectResponse
    {
        $passwordBaru = Str::random(8);

        $mitra->update(['password' => Hash::make($passwordBaru)]);

        return back()->with('status', "Password mitra direset. Password baru: {$passwordBaru}");
    }
}
