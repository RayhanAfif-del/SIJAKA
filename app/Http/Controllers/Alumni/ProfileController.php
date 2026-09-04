<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Http\Requests\Alumni\ProfileRequest;
use App\Models\InterviewRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $alumni = Auth::guard('alumni')->user();
        $requests = $alumni->interviewRequests()->with('mitra', 'lowongan')->latest()->get();

        return view('alumni.profile.edit', compact('alumni', 'requests'));
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $alumni = Auth::guard('alumni')->user();
        $data = $request->safe()->except(['cv', 'portfolio']);
        $data['is_visible'] = $request->boolean('is_visible');

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

        return back()->with('status', 'Profil dan dokumen berhasil diperbarui.');
    }

    public function respond(InterviewRequest $interviewRequest, string $status): RedirectResponse
    {
        abort_unless($interviewRequest->alumni_id === Auth::guard('alumni')->id(), 403);
        abort_unless(in_array($status, ['accepted', 'rejected'], true), 404);

        $interviewRequest->update(['status' => $status]);

        return back()->with('status', 'Permintaan wawancara berhasil diperbarui.');
    }

    public function download(string $document): Response
    {
        abort_unless(in_array($document, ['cv', 'portfolio'], true), 404);
        $alumni = Auth::guard('alumni')->user();
        $path = $alumni->{$document.'_path'};

        abort_unless($path && Storage::disk('local')->exists($path), 404);

        return Storage::disk('local')->download($path);
    }
}
