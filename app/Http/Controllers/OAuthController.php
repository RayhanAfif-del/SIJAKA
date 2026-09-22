<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Alumni;
use App\Models\Mitra;
use App\Models\User;
use App\Services\SipintuAlumniSyncService;
use App\Services\SipintuGatewayService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OAuthController extends Controller
{
    /**
     * Redirect pengguna ke portal login SiPintu Gateway
     */
    public function redirect(Request $request): RedirectResponse
    {
        $clientId = config('services.sipintu.client_id', env('SIPINTU_CLIENT_ID'));
        $clientSecret = config('services.sipintu.client_secret', env('SIPINTU_CLIENT_SECRET'));

        abort_unless($clientId && $clientSecret, 503, 'SiPintu SSO Gateway belum dikonfigurasi pada file .env.');

        $state = Str::random(40);
        $request->session()->put('sipintu_oauth_state', $state);

        $baseUrl = rtrim((string) config('services.sipintu.base_url', env('SIPINTU_BASE_URL', 'http://localhost:8000')), '/');
        $authorizePath = (string) config('services.sipintu.authorize_path', '/oauth/authorize');
        $redirectUri = (string) config('services.sipintu.redirect_uri', env('SIPINTU_REDIRECT_URI', url('/oauth/callback')));

        $url = "{$baseUrl}{$authorizePath}?" . http_build_query([
            'client_id'     => $clientId,
            'redirect_uri'  => $redirectUri,
            'response_type' => 'code',
            'state'         => $state,
        ]);

        return redirect()->away($url);
    }

    /**
     * Menerima kiriman pengguna dari Portal SiPintu (SSO Callback)
     */
    public function callback(Request $request): Response|JsonResponse|RedirectResponse
    {
        // 1. Tangani probe diagnostik / ping otomatis dari SiPintu Gateway tanpa redirect loop
        if (! $request->has('code') && ! $request->has('state')) {
            if ($request->wantsJson()
                || $request->isJson()
                || $request->has('test')
                || $request->has('ping')
                || $request->has('health')
                || str_contains((string) $request->header('User-Agent'), 'SiPintu')) {
                return response()->json([
                    'status'       => 'ok',
                    'healthy'      => true,
                    'success'      => true,
                    'message'      => 'Route callback SSO ditemukan dan aktif merespons.',
                    'callback_url' => route('oauth.callback', [], false),
                    'timestamp'    => now()->toIso8601String(),
                ]);
            }

            // Kembalikan HTTP 200 langsung agar mesin diagnostik SiPintu (Guzzle/cURL)
            // mendeteksi callback aktif tanpa perlu follow-redirect, dan jika dibuka oleh browser manusia
            // langsung dialihkan ke alur otorisasi SSO SiPintu agar otomatis login ke dashboard alumni.
            return response(
                '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Endpoint Callback SSO Aktif</title><meta http-equiv="refresh" content="0;url=' . route('oauth.redirect') . '"></head><body style="font-family:sans-serif;text-align:center;padding:40px;"><h3>Endpoint Callback SSO Aktif</h3><p>Mengalihkan otomatis ke otorisasi SiPintu...</p><script>window.location.href="' . route('oauth.redirect') . '";</script></body></html>',
                200,
                ['Content-Type' => 'text/html']
            );
        }

        if ($request->filled('error')) {
            return redirect()->route('login')->with('error', 'Login SiPintu dibatalkan atau gagal.');
        }

        // 2. Tangkap kode otorisasi dari SiPintu
        $code = (string) $request->input('code');

        if (! $code) {
            return redirect()->route('login')->with('error', 'Otorisasi dari SiPintu gagal: Kode otorisasi tidak ditemukan.');
        }

        // Validasi state jika diawali dari sesi lokal SIJAKA (SP-initiated), abaikan jika IdP-initiated langsung dari SiPintu
        if ($request->session()->has('sipintu_oauth_state')) {
            $expectedState = (string) $request->session()->pull('sipintu_oauth_state');
            $givenState = (string) $request->query('state');
            if ($expectedState !== '' && $givenState !== '' && ! hash_equals($expectedState, $givenState)) {
                return redirect()->route('login')->with('error', 'Sesi login SiPintu tidak valid atau sudah kedaluwarsa.');
            }
        }

        $baseUrl = rtrim((string) config('services.sipintu.base_url', env('SIPINTU_BASE_URL', 'http://localhost:8000')), '/');
        $clientId = config('services.sipintu.client_id', env('SIPINTU_CLIENT_ID'));
        $clientSecret = config('services.sipintu.client_secret', env('SIPINTU_CLIENT_SECRET'));
        $redirectUri = config('services.sipintu.redirect_uri', env('SIPINTU_REDIRECT_URI', url('/oauth/callback')));
        $tokenPath = config('services.sipintu.token_path', '/oauth/token');
        $userPath = config('services.sipintu.user_path', '/api/v1/user');

        try {
            // 3. Tukar kode dengan Access Token (Server-to-Server)
            $tokenUrl = str_starts_with($tokenPath, 'http') ? $tokenPath : "{$baseUrl}{$tokenPath}";
            $tokenResponse = Http::asForm()->acceptJson()->post($tokenUrl, [
                'grant_type'    => 'authorization_code',
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
                'redirect_uri'  => $redirectUri,
                'code'          => $code,
            ]);

            if ($tokenResponse->failed()) {
                $errorMsg = $tokenResponse->json('error_description')
                    ?? $tokenResponse->json('message')
                    ?? 'Gagal memverifikasi token ke SiPintu Gateway.';
                return redirect()->route('login')->with('error', $errorMsg);
            }

            $accessToken = $tokenResponse->json('access_token');
            if (! $accessToken) {
                return redirect()->route('login')->with('error', 'Access token SiPintu tidak ditemukan dalam respons.');
            }

            // 4. Ambil data profil siswa dari endpoint SiPintu Gateway
            $userUrl = str_starts_with($userPath, 'http') ? $userPath : "{$baseUrl}{$userPath}";
            $userResponse = Http::withToken($accessToken)
                ->acceptJson()
                ->get($userUrl);

            if ($userResponse->failed()) {
                return redirect()->route('login')->with('error', 'Gagal mengambil data akun dari SiPintu Gateway.');
            }

            $sipintuUser = $userResponse->json('data')
                ?? $userResponse->json('user')
                ?? $userResponse->json();

            $email = (string) (data_get($sipintuUser, 'email') ?? data_get($sipintuUser, 'user.email') ?? '');
            $externalId = (string) (data_get($sipintuUser, 'external_id') ?? data_get($sipintuUser, 'nis') ?? data_get($sipintuUser, 'student.nis') ?? '');
            if ($externalId === '' && is_numeric(data_get($sipintuUser, 'name'))) {
                $externalId = (string) data_get($sipintuUser, 'name');
            }
            if ($externalId === '' && is_numeric(data_get($sipintuUser, 'user.name'))) {
                $externalId = (string) data_get($sipintuUser, 'user.name');
            }

            // Nama kandidat siswa (hindari menggunakan string angka NIS jika ada nama asli)
            $candidateNama = data_get($sipintuUser, 'student.nama') ?? data_get($sipintuUser, 'nama');
            if (! $candidateNama && ! is_numeric(data_get($sipintuUser, 'name'))) {
                $candidateNama = data_get($sipintuUser, 'name');
            }
            $nama = (string) ($candidateNama ?? 'Alumni SiPintu');

            $incomingPassword = (string) (data_get($sipintuUser, 'password') ?? data_get($sipintuUser, 'password_hash'));
            $phone = data_get($sipintuUser, 'phone') ?? data_get($sipintuUser, 'student.hp') ?? data_get($sipintuUser, 'hp');
            $classroom = data_get($sipintuUser, 'classroom') ?? data_get($sipintuUser, 'student.classroom');
            $syncTime = now();

            $matchedUser = null;
            $matchedGuard = null;

            // Periksa jika terdaftar sebagai Admin atau Mitra
            if ($email !== '' && ($admin = Admin::where('email', $email)->first())) {
                $matchedUser = $admin;
                $matchedGuard = 'admin';
                if ($incomingPassword !== '') {
                    $admin->password = $incomingPassword;
                    $admin->save();
                }
            } elseif ($email !== '' && ($mitra = Mitra::where('email', $email)->first())) {
                $matchedUser = $mitra;
                $matchedGuard = 'mitra';
                if ($incomingPassword !== '') {
                    $mitra->password = $incomingPassword;
                    $mitra->save();
                }
            } else {
                // 5. Cocokkan dengan data siswa/alumni di database lokal (via NIS atau Email)
                if ($email === '' && $externalId === '') {
                    return redirect()->route('login')->with('error', 'Data akun dari SiPintu tidak memiliki informasi NIS atau Email yang valid.');
                }

                $alumniQuery = Alumni::query();
                if ($email !== '' && $externalId !== '') {
                    $alumniQuery->where(function ($q) use ($email, $externalId) {
                        $q->where('nis', $externalId)->orWhere('email', $email);
                    });
                } elseif ($externalId !== '') {
                    $alumniQuery->where('nis', $externalId);
                } elseif ($email !== '') {
                    $alumniQuery->where('email', $email);
                }

                $alumnus = $alumniQuery->first();

                if ($alumnus) {
                    $matchedUser = $alumnus;
                    $matchedGuard = 'alumni';

                    $updates = [];
                    // Sinkronisasi kata sandi hash dari SiPintu jika disediakan
                    if ($incomingPassword !== '' && $alumnus->password !== $incomingPassword) {
                        $updates['password'] = $incomingPassword;
                    }
                    if ($nama !== '' && ! is_numeric($nama)) {
                        $updates['nama'] = $nama;
                    }
                    if ($email !== '' && $alumnus->email !== $email) {
                        $updates['email'] = $email;
                    }
                    if ($phone && blank($alumnus->phone)) {
                        $updates['phone'] = $phone;
                    }
                    if ($classroom && blank($alumnus->classroom)) {
                        $updates['classroom'] = $classroom;
                    }

                    $updates['sipintu_last_synced_at'] = $syncTime;
                    $alumnus->fill($updates);
                    $alumnus->sipintu_last_synced_at = $syncTime;
                    $alumnus->updated_at = $syncTime;
                    $alumnus->save();
                } else {
                    // Auto-provisioning akun Alumni baru jika belum ada di database lokal
                    $jurusan = $this->resolveJurusan($sipintuUser);
                    $tahunLulus = $this->resolveTahunLulus($sipintuUser);

                    $matchedUser = Alumni::create([
                        'nama'                   => $nama,
                        'nis'                    => $externalId !== '' ? $externalId : Str::before($email, '@'),
                        'email'                  => $email !== '' ? $email : null,
                        'password'               => $incomingPassword !== '' ? $incomingPassword : bcrypt(Str::random(24)),
                        'jurusan'                => $jurusan,
                        'classroom'              => $classroom,
                        'phone'                  => $phone,
                        'tahun_lulus'            => $tahunLulus,
                        'status'                 => 'Belum Bekerja',
                        'sipintu_last_synced_at' => $syncTime,
                    ]);
                    $matchedGuard = 'alumni';
                }
            }

            if ($matchedUser && $matchedGuard) {
                Auth::guard($matchedGuard)->login($matchedUser, true);
                $request->session()->regenerate();

                $displayName = $matchedUser->nama ?? $matchedUser->name ?? 'User';

                $targetUrl = match ($matchedGuard) {
                    'alumni' => route('alumni.dashboard'),
                    'mitra' => route('mitra.dashboard'),
                    'admin' => route('admin.dashboard'),
                    default => route('dashboard'),
                };

                return redirect()->intended($targetUrl)->with('success', "Selamat datang, {$displayName}!");
            }

            return redirect()->route('login')->with('error', 'Akun SiPintu tidak dapat dipetakan ke profil SIJAKA.');
        } catch (\Throwable $exception) {
            Log::error('SiPintu SSO Callback Error: ' . $exception->getMessage(), [
                'trace' => $exception->getTraceAsString(),
            ]);

            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat memproses login SiPintu: ' . $exception->getMessage());
        }
    }

    /**
     * Webhook Sinkronisasi Real-Time & Smart Conflict Resolution dari SiPintu Gateway
     */
    public function syncUser(Request $request): JsonResponse
    {
        // 1. Mendukung probe / ping uji diagnostik dari SiPintu
        if ($request->isMethod('get')
            || empty($request->all())
            || $request->boolean('test')
            || $request->input('action') === 'ping'
            || $request->input('event') === 'ping'
            || $request->input('type') === 'ping'
            || $request->input('action') === 'test') {
            return response()->json([
                'status'    => 'ok',
                'healthy'   => true,
                'success'   => true,
                'message'   => 'SiPintu sync-user webhook endpoint is active and ready.',
                'timestamp' => now()->toIso8601String(),
            ]);
        }

        // 2. Verifikasi Signature HMAC SHA-256 (jika disediakan dan secret dikonfigurasi)
        $signature = $request->header('X-SiPintu-Signature');
        $secret = config('services.sipintu.client_secret', env('SIPINTU_CLIENT_SECRET'));

        if ($secret && $signature && ! hash_equals(hash_hmac('sha256', $request->getContent(), $secret), $signature)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid signature.'], 401);
        }

        try {
            $userData = $request->input('user') ?? $request->input('data') ?? $request->all();
            $previous = $request->input('previous', []);

            $email = (string) (data_get($userData, 'email') ?? data_get($userData, 'user.email'));
            $prevEmail = (string) (data_get($previous, 'email') ?? data_get($previous, 'user.email'));
            $externalId = (string) (data_get($userData, 'external_id') ?? data_get($userData, 'nis') ?? '');
            if ($externalId === '' && is_numeric(data_get($userData, 'name'))) {
                $externalId = (string) data_get($userData, 'name');
            }

            $nama = (string) (data_get($userData, 'name') ?? data_get($userData, 'nama') ?? '');
            $rawPassword = (string) (data_get($userData, 'password') ?? data_get($userData, 'password_hash') ?? data_get($userData, 'user.password'));
            $phone = data_get($userData, 'phone');
            $classroom = data_get($userData, 'classroom');

            $syncTime = now();

            // Cari User di database lokal (Alumni)
            $user = null;
            if ($externalId !== '') {
                $user = Alumni::where('nis', $externalId)->first();
            }
            if (! $user && $email !== '') {
                $user = Alumni::where('email', $email)->first();
            }
            if (! $user && $prevEmail !== '') {
                $user = Alumni::where('email', $prevEmail)->first();
            }

            // Periksa jika user terdaftar sebagai Admin atau Mitra
            if (! $user && $email !== '') {
                if ($admin = Admin::where('email', $email)->first()) {
                    if ($nama !== '' && ! is_numeric($nama)) $admin->nama = $nama;
                    if ($rawPassword !== '') $admin->password = $rawPassword;
                    $admin->save();
                    return response()->json(['status' => 'success', 'healthy' => true, 'action' => 'admin_updated', 'user_id' => $admin->id]);
                }
                if ($mitra = Mitra::where('email', $email)->first()) {
                    if ($rawPassword !== '') $mitra->password = $rawPassword;
                    $mitra->save();
                    return response()->json(['status' => 'success', 'healthy' => true, 'action' => 'mitra_updated', 'user_id' => $mitra->id]);
                }
            }

            // 3. Jika belum ada: Auto-provision akun baru
            if (! $user) {
                $jurusan = $this->resolveJurusan($userData);
                $tahunLulus = $this->resolveTahunLulus($userData);

                $newUser = Alumni::create([
                    'nama'                   => $nama !== '' ? $nama : 'Alumni SiPintu',
                    'nis'                    => $externalId !== '' ? $externalId : Str::before($email, '@'),
                    'email'                  => $email !== '' ? $email : null,
                    'password'               => $rawPassword !== '' ? $rawPassword : bcrypt(Str::random(32)),
                    'jurusan'                => $jurusan,
                    'classroom'              => $classroom,
                    'phone'                  => $phone,
                    'tahun_lulus'            => $tahunLulus,
                    'status'                 => 'Belum Bekerja',
                    'sipintu_last_synced_at' => $syncTime,
                ]);

                return response()->json([
                    'status'    => 'success',
                    'healthy'   => true,
                    'action'    => 'created',
                    'user_id'   => $newUser->id,
                    'nis'       => $newUser->nis,
                    'timestamp' => $syncTime->toIso8601String(),
                ]);
            }

            // 4. Deteksi Perubahan Lokal Pengguna (Smart Conflict Resolution)
            $hasLocalEdits = $user->sipintu_last_synced_at !== null
                && $user->updated_at instanceof \Illuminate\Support\Carbon
                && $user->updated_at->gt($user->sipintu_last_synced_at);

            // Field Selalu Mengikuti SiPintu (Source of Truth)
            $updateFields = [];
            if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $updateFields['email'] = $email;
            }
            if ($rawPassword !== '') {
                $updateFields['password'] = $rawPassword;
            }
            if (isset($userData['status']) && in_array($userData['status'], ['Bekerja', 'Belum Bekerja', 'Melanjutkan Studi', 'Berwirausaha'])) {
                $updateFields['status'] = $userData['status'];
            }

            // Field Lokal: Hanya ditimpa jika TIDAK ADA perubahan lokal
            if (! $hasLocalEdits) {
                if ($nama !== '' && ! is_numeric($nama)) {
                    $updateFields['nama'] = $nama;
                }
                if (isset($userData['phone'])) {
                    $updateFields['phone'] = $phone;
                }
                if (isset($userData['classroom'])) {
                    $updateFields['classroom'] = $classroom;
                }
                $jurusan = $this->resolveJurusan($userData);
                if ($jurusan !== 'Belum ditentukan' && ($user->jurusan === 'Belum ditentukan' || blank($user->jurusan))) {
                    $updateFields['jurusan'] = $jurusan;
                }
            }

            // 5. Update & Selaraskan Timestamp (mencegah false positive di sync berikutnya)
            $updateFields['sipintu_last_synced_at'] = $syncTime;
            $user->fill($updateFields);
            $user->sipintu_last_synced_at = $syncTime;
            $user->updated_at = $syncTime;
            $user->save();

            return response()->json([
                'status'    => 'success',
                'healthy'   => true,
                'action'    => 'updated',
                'user_id'   => $user->id,
                'nis'       => $user->nis,
                'conflict'  => $hasLocalEdits ? 'preserved_local_changes' : 'synced_fully',
                'timestamp' => $syncTime->toIso8601String(),
            ]);
        } catch (\Throwable $e) {
            Log::warning('SiPintu Webhook syncUser error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal memproses sinkronisasi user: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Webhook sinkronisasi kata sandi real-time dari SiPintu Gateway
     */
    public function syncPassword(Request $request): JsonResponse
    {
        // Mendukung probe / ping uji diagnostik dari SiPintu
        if ($request->isMethod('get')
            || empty($request->all())
            || $request->boolean('test')
            || $request->input('action') === 'ping'
            || $request->input('event') === 'ping'
            || $request->input('type') === 'ping'
            || $request->input('action') === 'test') {
            return response()->json([
                'status'    => 'ok',
                'healthy'   => true,
                'success'   => true,
                'message'   => 'SiPintu sync-password webhook endpoint is active and ready.',
                'timestamp' => now()->toIso8601String(),
            ]);
        }

        $signature = $request->header('X-SiPintu-Signature');
        $secret = config('services.sipintu.client_secret', env('SIPINTU_CLIENT_SECRET'));

        if ($secret && $signature && ! hash_equals(hash_hmac('sha256', $request->getContent(), $secret), $signature)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid signature.'], 401);
        }

        try {
            $payload = $request->input('user') ?? $request->input('data') ?? $request->all();

            $nis = (string) (data_get($payload, 'external_id') ?? data_get($payload, 'nis') ?? '');
            if ($nis === '' && is_numeric(data_get($payload, 'name'))) {
                $nis = (string) data_get($payload, 'name');
            }

            $email = (string) (data_get($payload, 'email') ?? data_get($payload, 'user.email'));
            $rawPassword = (string) (data_get($payload, 'password') ?? data_get($payload, 'password_hash') ?? data_get($payload, 'user.password'));

            if ($rawPassword === '') {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Password tidak disediakan dalam payload.',
                ], 422);
            }

            $updated = false;
            $syncTime = now();

            if ($nis !== '') {
                if ($alumni = Alumni::where('nis', $nis)->first()) {
                    $alumni->password = $rawPassword;
                    $alumni->sipintu_last_synced_at = $syncTime;
                    $alumni->updated_at = $syncTime;
                    $alumni->save();
                    $updated = true;
                }
            }

            if (! $updated && $email !== '') {
                if ($alumni = Alumni::where('email', $email)->first()) {
                    $alumni->password = $rawPassword;
                    $alumni->sipintu_last_synced_at = $syncTime;
                    $alumni->updated_at = $syncTime;
                    $alumni->save();
                    $updated = true;
                } elseif ($admin = Admin::where('email', $email)->first()) {
                    $admin->password = $rawPassword;
                    $admin->save();
                    $updated = true;
                } elseif ($mitra = Mitra::where('email', $email)->first()) {
                    $mitra->password = $rawPassword;
                    $mitra->save();
                    $updated = true;
                }
            }

            return response()->json([
                'status'    => $updated ? 'success' : 'not_found',
                'healthy'   => true,
                'updated'   => $updated,
                'message'   => $updated ? 'Password berhasil diperbarui.' : 'Akun tidak ditemukan di downstream.',
                'timestamp' => $syncTime->toIso8601String(),
            ], $updated ? 200 : 404);
        } catch (\Throwable $e) {
            Log::warning('SiPintu Webhook syncPassword error: ' . $e->getMessage());

            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal memperbarui password: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Health check downstream untuk SiPintu Gateway
     */
    public function health(): JsonResponse
    {
        return response()->json([
            'status'    => 'ok',
            'healthy'   => true,
            'success'   => true,
            'app'       => config('app.name', 'SIJAKA'),
            'service'   => 'sijaka-downstream',
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    /**
     * Logout sesi lokal pengguna
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('alumni')->logout();
        Auth::guard('mitra')->logout();
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('info', 'Anda telah keluar dari aplikasi.');
    }

    /**
     * Memetakan jurusan dari data SiPintu
     */
    protected function resolveJurusan(array $data): string
    {
        $jurusan = data_get($data, 'nama_jurusan')
            ?? data_get($data, 'jurusan.nama_jurusan')
            ?? data_get($data, 'jurusan');

        if (is_array($jurusan)) {
            $jurusan = data_get($jurusan, 'nama_jurusan') ?? data_get($jurusan, 'kode_jurusan');
        }

        if (is_string($jurusan) && $jurusan !== '' && $jurusan !== 'Belum ditentukan') {
            return $jurusan;
        }

        return app(SipintuAlumniSyncService::class)->determineJurusan($data);
    }

    /**
     * Memetakan tahun kelulusan dari data SiPintu
     */
    protected function resolveTahunLulus(array $data): string
    {
        return app(SipintuAlumniSyncService::class)->determineTahunLulus($data);
    }
}
