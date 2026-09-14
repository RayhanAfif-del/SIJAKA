<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ProfileController extends Controller
{
    /**
     * Show the edit form for the authenticated alumni.
     */
    public function edit(Request $request)
    {
        /** @var Alumni $alumni */
        $alumni = $request->user();
        return view('alumni.profile.edit', compact('alumni'));
    }

    /**
     * Update the alumni profile.
     */
    public function update(Request $request)
    {
        /** @var Alumni $alumni */
        $alumni = $request->user();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:alumni,email,' . $alumni->id,
            'password' => 'nullable|confirmed|min:8',
            'foto_path' => 'nullable|image|max:2048',
            // add other fields as needed
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        if ($request->hasFile('foto_path')) {
            // store new photo and delete old one if exists
            if ($alumni->foto_path) {
                Storage::delete($alumni->foto_path);
            }
            $validated['foto_path'] = $request->file('foto_path')->store('alumni/photos');
        }

        $alumni->update($validated);

        return redirect()->route('alumni.dashboard')->with('status', 'Profil berhasil diperbarui.');
    }

    /**
     * Download a document belonging to the alumni.
     */
    public function download(string $document)
    {
        $alumni = auth('alumni')->user();
        $path = "alumni/documents/{$document}"; // example storage path
        if (!Storage::exists($path)) {
            abort(404);
        }
        return Storage::download($path);
    }

    /**
     * Respond to an interview request (accept or reject).
     */
    public function respond(string $interviewRequest, string $status)
    {
        $alumni = auth('alumni')->user();
        $requestModel = $alumni->interviewRequests()->where('id', $interviewRequest)->firstOrFail();
        $requestModel->status = $status;
        $requestModel->save();
        return back()->with('status', 'Respon wawancara berhasil disimpan.');
    }
}
