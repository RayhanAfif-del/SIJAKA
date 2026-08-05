<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfilBkkRequest;
use App\Models\ProfilBkk;
use Illuminate\Http\RedirectResponse;

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
        ProfilBkk::singleton()->update($request->validated());

        return back()->with('status', 'Profil BKK berhasil diperbarui.');
    }
}
