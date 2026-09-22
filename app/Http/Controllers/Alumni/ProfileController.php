<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $alumni = Auth::guard('alumni')->user() ?? $request->user('alumni');
        return view('alumni.profile.edit', compact('alumni'));
    }

    /**
     * Update the alumni profile.
     */
    public function update(Request $request)
    {
        /** @var Alumni $alumni */
        $alumni = Auth::guard('alumni')->user() ?? $request->user('alumni');

        $validated = $request->validate([
            'headline'      => 'nullable|string|max:255',
            'ringkasan'     => 'nullable|string',
            'keahlian'      => 'nullable|string|max:500',
            'portfolio_url' => 'nullable|string|max:255',
            'linkedin_url'  => 'nullable|string|max:255',
            'instagram_url' => 'nullable|string|max:255',
            'tiktok_url'    => 'nullable|string|max:255',
            'foto'          => 'nullable|image|max:2048',
            'cv'            => 'nullable|mimes:pdf,doc,docx|max:5120',
            'portfolio'     => 'nullable|mimes:pdf,zip|max:10240',
            'is_visible'    => 'nullable|boolean',
        ]);

        $data = [
            'headline'      => $validated['headline'] ?? null,
            'ringkasan'     => $validated['ringkasan'] ?? null,
            'keahlian'      => $validated['keahlian'] ?? null,
            'portfolio_url' => $this->normalizeUrl($validated['portfolio_url'] ?? null),
            'linkedin_url'  => $this->normalizeSocialUrl($validated['linkedin_url'] ?? null, 'linkedin'),
            'instagram_url' => $this->normalizeSocialUrl($validated['instagram_url'] ?? null, 'instagram'),
            'tiktok_url'    => $this->normalizeSocialUrl($validated['tiktok_url'] ?? null, 'tiktok'),
        ];

        // Foto Profil
        if ($request->hasFile('foto')) {
            if ($alumni->foto_path && Storage::disk('public')->exists($alumni->foto_path)) {
                Storage::disk('public')->delete($alumni->foto_path);
            }
            $data['foto_path'] = $request->file('foto')->store('alumni/photos', 'public');
        }

        // CV File
        if ($request->hasFile('cv')) {
            if ($alumni->cv_path && Storage::disk('local')->exists($alumni->cv_path)) {
                Storage::disk('local')->delete($alumni->cv_path);
            }
            $data['cv_path'] = $request->file('cv')->store('alumni/cv', 'local');
        }

        // Portfolio File
        if ($request->hasFile('portfolio')) {
            if ($alumni->portfolio_path && Storage::disk('local')->exists($alumni->portfolio_path)) {
                Storage::disk('local')->delete($alumni->portfolio_path);
            }
            $data['portfolio_path'] = $request->file('portfolio')->store('alumni/portfolios', 'local');
        }

        // Talent Pool Visibility & Approval
        $wantsPublication = $request->boolean('is_visible');
        if ($wantsPublication) {
            if ($alumni->talent_approval_status === 'disetujui') {
                $data['is_visible'] = true;
            } else {
                $data['talent_approval_status'] = 'menunggu';
                $data['is_visible'] = false;
            }
        } else {
            $data['is_visible'] = false;
        }

        $alumni->update($data);

        return redirect()->route('alumni.profile.edit')->with('status', 'Profil talenta berhasil diperbarui.');
    }

    /**
     * Normalize standard URL.
     */
    protected function normalizeUrl(?string $url): ?string
    {
        if (!$url || trim($url) === '') {
            return null;
        }
        $url = trim($url);
        if (!preg_match('~^(?:f|ht)tps?://~i', $url)) {
            $url = 'https://' . $url;
        }
        return filter_var($url, FILTER_VALIDATE_URL) ? $url : null;
    }

    /**
     * Normalize social media URL or handle.
     */
    protected function normalizeSocialUrl(?string $value, string $platform): ?string
    {
        if (!$value || trim($value) === '') {
            return null;
        }
        $value = trim($value);

        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        $clean = ltrim($value, '@');

        return match ($platform) {
            'linkedin'  => str_contains($value, 'linkedin.com') ? 'https://' . ltrim($value, '/') : 'https://www.linkedin.com/in/' . $clean,
            'instagram' => str_contains($value, 'instagram.com') ? 'https://' . ltrim($value, '/') : 'https://www.instagram.com/' . $clean,
            'tiktok'    => str_contains($value, 'tiktok.com') ? 'https://' . ltrim($value, '/') : 'https://www.tiktok.com/@' . $clean,
            default     => 'https://' . $value,
        };
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
}
