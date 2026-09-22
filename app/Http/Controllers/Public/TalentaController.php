<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Storage;

class TalentaController extends Controller
{
    public function index(Request $request)
    {
        $talenta = Alumni::query()
            ->where('is_visible', true)
            ->where('talent_approval_status', 'disetujui')
            ->when($request->filled('cari'), function ($query) use ($request) {
                $term = '%'.$request->string('cari')->trim().'%';
                $query->where(function ($inner) use ($term) {
                    $inner->where('nama', 'like', $term)
                        ->orWhere('jurusan', 'like', $term)
                        ->orWhere('headline', 'like', $term)
                        ->orWhere('keahlian', 'like', $term);
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('public.talenta.index', compact('talenta'));
    }

    public function show(Alumni $alumni)
    {
        abort_unless(
            $alumni->is_visible && $alumni->talent_approval_status === 'disetujui',
            404
        );

        $whatsappNumber = preg_replace('/\D+/', '', (string) Kontak::singleton()->telepon);
        if (str_starts_with($whatsappNumber, '0')) {
            $whatsappNumber = '62'.substr($whatsappNumber, 1);
        }

        return view('public.talenta.show', compact('alumni', 'whatsappNumber'));
    }

    public function viewDocument(Alumni $alumni, string $document)
    {
        abort_unless(
            $alumni->is_visible && $alumni->talent_approval_status === 'disetujui',
            404
        );
        abort_unless(in_array($document, ['cv', 'portfolio'], true), 404);

        $path = $alumni->{$document . '_path'};
        abort_unless($path && Storage::disk('local')->exists($path), 404);

        $extension = pathinfo($path, PATHINFO_EXTENSION) ?: 'pdf';
        $filename = strtoupper($document) . '-' . \Illuminate\Support\Str::slug($alumni->nama) . '.' . $extension;

        return Storage::disk('local')->response($path, $filename);
    }

    public function downloadDocument(Alumni $alumni, string $document): StreamedResponse
    {
        abort_unless(
            $alumni->is_visible && $alumni->talent_approval_status === 'disetujui',
            404
        );
        abort_unless(in_array($document, ['cv', 'portfolio'], true), 404);

        $path = $alumni->{$document . '_path'};
        abort_unless($path && Storage::disk('local')->exists($path), 404);

        $extension = pathinfo($path, PATHINFO_EXTENSION) ?: 'pdf';
        $filename = strtoupper($document) . '-' . \Illuminate\Support\Str::slug($alumni->nama) . '.' . $extension;

        return Storage::disk('local')->download($path, $filename);
    }

    public function download(Alumni $alumni, string $document): StreamedResponse
    {
        return $this->downloadDocument($alumni, $document);
    }
}