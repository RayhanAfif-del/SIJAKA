<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\InterviewRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TalentPoolController extends Controller
{
    public function index(Request $request)
    {
        $alumni = Alumni::query()
            ->where('is_visible', true)
            ->whereNotNull('email')
            ->when($request->filled('cari'), function ($query) use ($request) {
                $term = '%'.$request->string('cari')->trim().'%';
                $query->where(fn ($q) => $q->where('nama', 'like', $term)
                    ->orWhere('jurusan', 'like', $term)
                    ->orWhere('headline', 'like', $term)
                    ->orWhere('keahlian', 'like', $term));
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $requestedIds = InterviewRequest::where('mitra_id', Auth::guard('mitra')->id())
            ->pluck('alumni_id')
            ->all();

        return view('mitra.talent-pool.index', compact('alumni', 'requestedIds'));
    }

    public function requestInterview(Request $request, Alumni $alumni): RedirectResponse
    {
        abort_unless($alumni->is_visible, 404);

        $data = $request->validate([
            'message' => ['nullable', 'string', 'max:2000'],
            'lowongan_id' => ['nullable', 'integer', 'exists:lowongan,id'],
        ]);

        if (! empty($data['lowongan_id'])) {
            abort_unless(Auth::guard('mitra')->user()->lowongan()->whereKey($data['lowongan_id'])->exists(), 403);
        }

        InterviewRequest::firstOrCreate(
            [
                'alumni_id' => $alumni->id,
                'mitra_id' => Auth::guard('mitra')->id(),
                'lowongan_id' => $data['lowongan_id'] ?? null,
            ],
            ['message' => $data['message'] ?? null]
        );

        return back()->with('status', 'Permintaan wawancara berhasil dikirim. Kontak alumni tetap terlindungi.');
    }

    public function requests()
    {
        $requests = InterviewRequest::with('alumni', 'lowongan')
            ->where('mitra_id', Auth::guard('mitra')->id())
            ->latest()
            ->paginate(15);

        return view('mitra.talent-pool.requests', compact('requests'));
    }

    public function download(Alumni $alumni, string $document)
    {
        abort_unless(in_array($document, ['cv', 'portfolio'], true), 404);
        abort_unless(InterviewRequest::where('mitra_id', Auth::guard('mitra')->id())
            ->where('alumni_id', $alumni->id)
            ->where('status', 'accepted')
            ->exists(), 403);

        $path = $alumni->{$document.'_path'};
        abort_unless($path && Storage::disk('local')->exists($path), 404);

        return Storage::disk('local')->download($path);
    }
}
