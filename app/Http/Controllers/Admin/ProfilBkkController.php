<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfilBkkRequest;
use App\Models\ProfilBkk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProfilBkkController extends Controller
{
    public function edit()
    {
        return view('admin.profil-bkk.edit', [
            'profilBkk' => ProfilBkk::singleton(),
        ]);
    }

    public function update(ProfilBkkRequest $request): RedirectResponse
    {
        $profilBkk = ProfilBkk::singleton();
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            if ($profilBkk->gambar) {
                Storage::disk('public')->delete($profilBkk->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('profil-bkk', 'public');
        } else {
            unset($data['gambar']);
        }

        $profilBkk->update($data);

        return back()->with('status', 'Profil BKK berhasil diperbarui.');
    }
}
