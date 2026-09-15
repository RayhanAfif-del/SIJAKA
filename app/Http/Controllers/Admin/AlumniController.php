<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AlumniController extends Controller
{
    /**
     * Display a listing of alumni.
     */
    public function index(Request $request)
    {
        $statusCounts = [
            'total'             => Alumni::count(),
            'Bekerja'           => Alumni::where('status', 'Bekerja')->count(),
            'Berwirausaha'      => Alumni::where('status', 'Berwirausaha')->count(),
            'Melanjutkan Studi' => Alumni::where('status', 'Melanjutkan Studi')->count(),
            'Belum Bekerja'     => Alumni::where('status', 'Belum Bekerja')->count(),
        ];

        $alumni = Alumni::query()
            ->when($request->filled('cari'), function ($query) use ($request) {
                $search = $request->input('cari');
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('nis', 'like', "%{$search}%")
                      ->orWhere('jurusan', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->input('status'));
            })
            ->orderBy('nama')
            ->paginate(15)
            ->withQueryString();

        return view('admin.alumni.index', compact('alumni', 'statusCounts'));
    }

    /**
     * Show the form for creating a new alumni.
     */
    public function create()
    {
        return view('admin.alumni.create');
    }

    /**
     * Store a newly created alumni.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'nis'         => 'nullable|string|max:50|unique:alumni,nis',
            'jurusan'     => 'required|string|max:255',
            'tahun_lulus' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 5),
            'status'      => 'required|string|in:Bekerja,Berwirausaha,Melanjutkan Studi,Belum Bekerja',
            'email'       => 'nullable|email|unique:alumni,email',
            'password'    => 'nullable|min:8',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            // Default password dari NIS atau tanggal jika tidak diisi
            $defaultPass = !empty($validated['nis']) ? $validated['nis'] : 'smkn1bangsri';
            $validated['password'] = bcrypt($defaultPass);
        }

        if (empty($validated['email']) && !empty($validated['nis'])) {
            $validated['email'] = $validated['nis'] . '@smkn1bangsri.sch.id';
        }

        if ($request->hasFile('foto_path')) {
            $validated['foto_path'] = $request->file('foto_path')->store('alumni/photos');
        }

        Alumni::create($validated);

        return redirect()->route('admin.alumni.index')->with('status', 'Alumni berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified alumni.
     */
    public function edit(Alumni $alumni)
    {
        return view('admin.alumni.edit', compact('alumni'));
    }

    /**
     * Update the specified alumni.
     */
    public function update(Request $request, Alumni $alumni)
    {
        // Email & password dikelola otomatis oleh Sipintu, tidak perlu divalidasi atau diubah di sini.
        $validated = $request->validate([
            'nama'                   => 'required|string|max:255',
            'nis'                    => "nullable|string|max:50|unique:alumni,nis,{$alumni->id}",
            'jurusan'                => 'required|string|max:255',
            'tahun_lulus'            => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 5),
            'status'                 => 'required|string|in:Bekerja,Berwirausaha,Melanjutkan Studi,Belum Bekerja',
            // optional extra fields
            'headline'               => 'nullable|string|max:255',
            'ringkasan'              => 'nullable|string',
            'keahlian'               => 'nullable|string',
            'portfolio_url'          => 'nullable|url',
            'linkedin_url'           => 'nullable|string|max:255',
            'instagram_url'          => 'nullable|string|max:255',
            'tiktok_url'             => 'nullable|string|max:255',
            'is_visible'             => 'nullable|boolean',
            'talent_approval_status' => 'nullable|string',
        ]);

        if ($request->hasFile('foto_path')) {
            if ($alumni->foto_path) {
                Storage::delete($alumni->foto_path);
            }
            $validated['foto_path'] = $request->file('foto_path')->store('alumni/photos');
        }

        $alumni->update($validated);

        return redirect()->route('admin.alumni.index')->with('status', 'Alumni berhasil diperbarui.');
    }

    /**
     * Remove the specified alumni from storage.
     */
    public function destroy(Alumni $alumni)
    {
        if ($alumni->foto_path) {
            Storage::delete($alumni->foto_path);
        }
        $alumni->delete();
        return redirect()->route('admin.alumni.index')->with('status', 'Alumni berhasil dihapus.');
    }

    /**
     * Sync alumni data from external Sipintu service.
     */
    public function syncSipintu()
    {
        // Placeholder for actual sync logic – could dispatch a job or call a service.
        // For now we simply flash a message.
        return redirect()->route('admin.alumni.index')->with('status', 'Sinkronisasi Sipintu dijalankan.');
}

    /**
     * Convert alumni with status 'Belum Bekerja' to 'Berwirausaha'.
     */
    public function convertUnemployedToEntrepreneur(Request $request)
    {
        $updated = Alumni::where('status', 'Belum Bekerja')->update(['status' => 'Berwirausaha']);
        return redirect()->route('admin.alumni.index')->with('status', "{$updated} alumni berhasil diubah menjadi Berwirausaha.");
    }

}
