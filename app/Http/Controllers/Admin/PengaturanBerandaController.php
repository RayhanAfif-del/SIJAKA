<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PengaturanWebsiteRequest;
use App\Models\PengaturanWebsite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

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
        $pengaturanWebsite = PengaturanWebsite::singleton();
        $data = $request->validated();

        if ($request->hasFile('site_icon')) {
            if ($pengaturanWebsite->site_icon) {
                Storage::disk('public')->delete($pengaturanWebsite->site_icon);
            }

            $data['site_icon'] = $request->file('site_icon')->store('website', 'public');
        } else {
            unset($data['site_icon']);
        }

        if ($request->hasFile('hero_image')) {
            if ($pengaturanWebsite->hero_image) {
                Storage::disk('public')->delete($pengaturanWebsite->hero_image);
            }

            $data['hero_image'] = $request->file('hero_image')->store('website', 'public');
        } else {
            unset($data['hero_image']);
        }

        $pengaturanWebsite->update($data);

        return back()->with('status', 'Pengaturan beranda berhasil diperbarui.');
    }
}
