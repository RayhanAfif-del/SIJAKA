<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mitra\ProfilRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function edit()
    {
        return view('mitra.profil.edit', [
            'mitra' => Auth::guard('mitra')->user(),
        ]);
    }

    public function update(ProfilRequest $request): RedirectResponse
    {
        $mitra = Auth::guard('mitra')->user();
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            if ($mitra->logo) {
                Storage::disk('public')->delete($mitra->logo);
            }
            $data['logo'] = $request->file('logo')->store('mitra', 'public');
        }

        $mitra->update($data);

        return back()->with('status', 'Profil perusahaan berhasil diperbarui.');
    }
}
