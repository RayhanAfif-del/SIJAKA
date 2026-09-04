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

            foreach ([
                'admin' => Admin::class,
                'mitra' => Mitra::class,
                'alumni' => Alumni::class,
            ] as $guard => $model) {
                $user = $model::where('email', $email)->first();

                if ($user) {
                    Auth::guard($guard)->login($user, true);
                    $request->session()->regenerate();

                    return redirect()->route(match ($guard) {
                        'admin' => 'admin.dashboard',
                        'mitra' => 'mitra.dashboard',
                        default => 'alumni.profile.edit',
                    });
                }
            }

            return redirect()->route('login')->withErrors(['email' => 'Email SiPintu belum terdaftar sebagai akun SIJAKA.']);
        } catch (\Throwable $exception) {
            Log::error('SiPintu SSO callback failed', ['exception' => $exception]);

            return redirect()->route('login')->withErrors(['email' => 'Login SiPintu tidak dapat diproses.']);
        }
    }
}