<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlumniRequest;
use App\Models\Alumni;
use App\Services\SipintuAlumniSyncService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function syncSipintu(SipintuAlumniSyncService $syncService): RedirectResponse
    {
        try {
            $result = $syncService->sync(deleteDummy: true);
            $syncedAlumni = $result['synced'];
            $totalReceived = $result['total_received'];

            return redirect()->route('admin.alumni.index')->with(
                'status',
                "Sinkronisasi SiPintu berhasil. {$syncedAlumni} data alumni (classroom = null) dari {$totalReceived} data yang diterima berhasil disinkronkan."
            );
        } catch (\Throwable $exception) {
            Log::warning('SiPintu alumni synchronization failed', [
                'message' => $exception->getMessage(),
                'exception' => $exception,
            ]);

            return redirect()->route('admin.alumni.index')->with('error', 'Sinkronisasi SiPintu gagal. Periksa konfigurasi dan koneksi gateway.');
        }
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
