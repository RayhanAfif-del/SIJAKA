<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Alumni;
use App\Models\Mitra;
use App\Services\SipintuGatewayService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SipintuController extends Controller
{
    public function __construct(private readonly SipintuGatewayService $gateway) {}

    public function redirect(Request $request): RedirectResponse
    {
        abort_unless(config('services.sipintu.client_id') && config('services.sipintu.client_secret'), 503, 'SiPintu belum dikonfigurasi.');

        $state = Str::random(40);
        $request->session()->put('sipintu_oauth_state', $state);

        return redirect()->away($this->gateway->authorizationUrl($state));
    }

    public function callback(Request $request): RedirectResponse
    {
        $state = (string) $request->query('state');
        $expectedState = (string) $request->session()->pull('sipintu_oauth_state');

        if (! $state || ! $expectedState || ! hash_equals($expectedState, $state)) {
            return redirect()->route('login')->withErrors(['email' => 'Sesi login SiPintu tidak valid atau sudah kedaluwarsa.']);
        }

        if ($request->filled('error') || ! $request->filled('code')) {
            return redirect()->route('login')->withErrors(['email' => 'Login SiPintu dibatalkan atau gagal.']);
        }

        try {
            $tokenResponse = $this->gateway->exchangeCode((string) $request->query('code'));
            abort_unless($tokenResponse->successful() && $tokenResponse->json('access_token'), 502, 'Token SiPintu tidak valid.');

            $profileResponse = $this->gateway->user((string) $tokenResponse->json('access_token'));
            abort_unless($profileResponse->successful(), 502, 'Profil SiPintu tidak dapat diambil.');

            $profile = $profileResponse->json('data')
                ?? $profileResponse->json('user')
                ?? $profileResponse->json();
            $email = (string) data_get($profile, 'email');
            abort_unless($email, 422, 'Profil SiPintu tidak memiliki email.');

            $nis = (string) (data_get($profile, 'nis')
                ?? (is_numeric(data_get($profile, 'name')) ? data_get($profile, 'name') : ''));

            $matchedUser = null;
            $matchedGuard = null;

            if ($admin = Admin::where('email', $email)->first()) {
                $matchedUser = $admin;
                $matchedGuard = 'admin';
            } elseif ($mitra = Mitra::where('email', $email)->first()) {
                $matchedUser = $mitra;
                $matchedGuard = 'mitra';
            } else {
                $alumniQuery = Alumni::where('email', $email);
                if ($nis !== '') {
                    $alumniQuery->orWhere('nis', $nis);
                }
                $alumnus = $alumniQuery->first();

                if ($alumnus) {
                    $matchedUser = $alumnus;
                    $matchedGuard = 'alumni';

                    // Update data profil alumni secara otomatis dari SiPintu
                    $updates = [];
                    $incomingName = data_get($profile, 'nama', data_get($profile, 'name'));
                    if ($incomingName && ! is_numeric($incomingName)) {
                        $updates['nama'] = $incomingName;
                    }
                    if ($email && $alumnus->email !== $email) {
                        $updates['email'] = $email;
                    }
                    if (! empty($updates)) {
                        $alumnus->update($updates);
                    }
                } else {
                    // Auto-register alumni dari data SiPintu jika belum ada
                    $matchedUser = Alumni::create([
                        'nama' => data_get($profile, 'nama', data_get($profile, 'name', 'Alumni SiPintu')),
                        'nis' => $nis !== '' ? $nis : Str::before($email, '@'),
                        'email' => $email,
                        'password' => 'password',
                        'jurusan' => 'Belum ditentukan',
                        'tahun_lulus' => (string) config('services.sipintu.default_graduation_year', date('Y')),
                        'status' => 'Belum Bekerja',
                    ]);
                    $matchedGuard = 'alumni';
                }
            }

            if ($matchedUser && $matchedGuard) {
                Auth::guard($matchedGuard)->login($matchedUser, true);
                $request->session()->regenerate();

                return redirect()->route(match ($matchedGuard) {
                    'admin' => 'admin.dashboard',
                    'mitra' => 'mitra.dashboard',
                    default => 'alumni.profile.edit',
                });
            }

            return redirect()->route('login')->withErrors(['email' => 'Akun SiPintu tidak dapat diproses di SIJAKA.']);
        } catch (\Throwable $exception) {
            Log::error('SiPintu SSO callback failed', ['exception' => $exception]);

            return redirect()->route('login')->withErrors(['email' => 'Login SiPintu tidak dapat diproses.']);
        }
    }
}