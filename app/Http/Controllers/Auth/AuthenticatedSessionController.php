<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create(Request $request): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::guard('mitra')->check()) {
            return redirect()->route('mitra.dashboard');
        }

        if (Auth::guard('alumni')->check()) {
            return redirect()->route('alumni.dashboard');
        }

        // Otomatis arahkan ke SSO hanya jika ada parameter eksplisit sso / from_sipintu
        $fromSipintu = $request->has('from_sipintu') || $request->has('sso');

        if ($fromSipintu && ! $request->has('manual') && ! session('error')) {
            return redirect()->route('oauth.redirect');
        }

        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $role = $request->string('role')->value();

        return match ($role) {
            'mitra' => redirect()->route('mitra.dashboard'),
            'alumni' => redirect()->route('alumni.dashboard'),
            default => redirect()->route('login'),
        };
    }

    public function createAdmin(): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.admin-login');
    }

    public function storeAdmin(AdminLoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function destroyAdmin(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function destroyMitra(Request $request): RedirectResponse
    {
        Auth::guard('mitra')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function destroyAlumni(Request $request): RedirectResponse
    {
        Auth::guard('alumni')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $guard = null;
        if (Auth::guard('admin')->check()) {
            $guard = 'admin';
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('mitra')->check()) {
            $guard = 'mitra';
            Auth::guard('mitra')->logout();
        } elseif (Auth::guard('alumni')->check()) {
            $guard = 'alumni';
            Auth::guard('alumni')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route($guard === 'admin' ? 'admin.login' : 'login');
    }
}
