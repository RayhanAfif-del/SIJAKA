<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KontakRequest;
use App\Models\Kontak;
use Illuminate\Http\RedirectResponse;

class KontakController extends Controller
{
    public function edit()
    {
        return view('admin.kontak.edit', [
            'kontak' => Kontak::singleton(),
        ]);
    }

    public function update(KontakRequest $request): RedirectResponse
    {
        Kontak::singleton()->update($request->validated());

        return back()->with('status', 'Data kontak berhasil diperbarui.');
    }
}
