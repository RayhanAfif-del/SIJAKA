<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlumniRequest;
use App\Models\Alumni;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $alumni = Alumni::when($request->filled('cari'), fn ($q) => $q->where(function ($query) use ($request) {
            $query->where('nama', 'like', '%'.$request->input('cari').'%')
                ->orWhere('nis', 'like', '%'.$request->input('cari').'%');
        }))
            ->orderByRaw('nis IS NULL, nis ASC')
            ->orderBy('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.alumni.index', compact('alumni'));
    }

    public function create()
    {
        return view('admin.alumni.create');
    }

    public function store(AlumniRequest $request): RedirectResponse
    {
        Alumni::create($request->validated());

        return redirect()->route('admin.alumni.index')->with('status', 'Data alumni berhasil ditambahkan.');
    }

public function edit(Alumni $alumnus)
    {
        return view('admin.alumni.edit', ['alumni' => $alumnus]);
    }

    public function update(AlumniRequest $request, Alumni $alumnus): RedirectResponse
    {
        $data = $request->validated();
        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }
        $alumnus->update($data);

        return redirect()->route('admin.alumni.index')->with('status', 'Data alumni berhasil diperbarui.');
    }

    public function destroy(Alumni $alumnus): RedirectResponse
    {
        $alumnus->delete();

        return back()->with('status', 'Data alumni berhasil dihapus.');
    }
}
