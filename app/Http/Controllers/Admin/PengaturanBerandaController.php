<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PengaturanWebsiteRequest;
use App\Models\PengaturanWebsite;
use Illuminate\Http\RedirectResponse;

class PengaturanBerandaController extends Controller
{
    public function edit()
    {
        return view('admin.pengaturan-beranda', [
            'pengaturanWebsite' => PengaturanWebsite::singleton(),
        ]);
    }

    public function update(PengaturanWebsiteRequest $request): RedirectResponse
    {
        PengaturanWebsite::singleton()->update($request->validated());

        return back()->with('status', 'Pengaturan beranda berhasil diperbarui.');
    }
}
