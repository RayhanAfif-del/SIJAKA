<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Http\Requests\Alumni\ProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProfileController extends Controller
{
    public function edit()
    {
        $alumni = Auth::guard('alumni')->user();
        return view('alumni.profile.edit', compact('alumni'));
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $alumni = Auth::guard('alumni')->user();
        $data = $request->safe()->except(['cv', 'portfolio', 'foto']);
        $wantsPublication = $request->boolean('is_visible');
        $data['is_visible'] = false;
        $data['talent_approval_status'] = $wantsPublication ? 'menunggu' : 'ditolak';

        if ($request->hasFile('foto')) {
            if ($alumni->foto_path) {
                Storage::disk('public')->delete($alumni->foto_path);
            }
            $data['foto_path'] = $request->file('foto')->store('alumni/'.$alumni->id, 'public');
        }

        foreach (['cv', 'portfolio'] as $document) {
            if (! $request->hasFile($document)) {
                continue;
            }

            $column = $document.'_path';
            if ($alumni->{$column}) {
                Storage::disk('local')->delete($alumni->{$column});
            }
            $data[$column] = $request->file($document)->store('alumni/'.$alumni->id, 'local');
        }

        $alumni->update($data);

        $message = $wantsPublication
            ? 'Profil berhasil diperbarui dan menunggu persetujuan admin sebelum dipublikasikan.'
            : 'Profil berhasil diperbarui dan tidak ditampilkan di Talent Pool.';

        return back()->with('status', $message);
    }

    public function respond(InterviewRequest $interviewRequest, string $status): RedirectResponse
    {
        abort_unless($interviewRequest->alumni_id === Auth::guard('alumni')->id(), 403);
        abort_unless(in_array($status, ['accepted', 'rejected'], true), 404);

        $interviewRequest->update(['status' => $status]);

        return back()->with('status', 'Permintaan wawancara berhasil diperbarui.');
    }

    public function download(string $document): StreamedResponse
    {
        abort_unless(in_array($document, ['cv', 'portfolio'], true), 404);
        $alumni = Auth::guard('alumni')->user();
        $path = $alumni->{$document.'_path'};

        abort_unless($path && Storage::disk('local')->exists($path), 404);

        return Storage::disk('local')->download($path);
    }
}
