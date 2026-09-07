<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TalentPoolController extends Controller
{
    public function index(Request $request)
    {
        $talents = Alumni::query()
            ->where(function ($query) {
                $query->whereNotNull('headline')
                    ->orWhereNotNull('ringkasan')
                    ->orWhereNotNull('keahlian')
                    ->orWhereNotNull('cv_path')
                    ->orWhereNotNull('portfolio_path');
            })
            ->when($request->filled('status'), fn ($query) => $query->where('talent_approval_status', $request->input('status')))
            ->when($request->filled('cari'), fn ($query) => $query->where(function ($inner) use ($request) {
                $term = '%'.$request->input('cari').'%';
                $inner->where('nama', 'like', $term)
                    ->orWhere('headline', 'like', $term)
                    ->orWhere('keahlian', 'like', $term);
            }))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.talent-pool.index', compact('talents'));
    }

    public function show(Alumni $alumni)
    {
        return view('admin.talent-pool.show', compact('alumni'));
    }

    public function download(Alumni $alumni, string $document): StreamedResponse
    {
        abort_unless(in_array($document, ['cv', 'portfolio'], true), 404);

        $path = $alumni->{$document.'_path'};
        abort_unless($path && Storage::disk('local')->exists($path), 404);

        return Storage::disk('local')->download($path);
    }

    public function approve(Alumni $alumni): RedirectResponse
    {
        $alumni->update(['talent_approval_status' => 'disetujui', 'is_visible' => true]);

        return back()->with('status', "Talenta {$alumni->nama} disetujui dan dipublikasikan.");
    }

    public function reject(Alumni $alumni): RedirectResponse
    {
        $alumni->update(['talent_approval_status' => 'ditolak', 'is_visible' => false]);

        return back()->with('status', "Talenta {$alumni->nama} ditolak dan tidak dipublikasikan.");
    }
}