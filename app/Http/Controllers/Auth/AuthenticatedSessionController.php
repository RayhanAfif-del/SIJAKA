<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create(): \Illuminate\View\View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $role = $request->string('role')->value();

        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'mitra' => redirect()->route('mitra.dashboard'),
            'alumni' => redirect()->route('alumni.profile.edit'),
            default => redirect()->route('login'),
        };
    }

    public function destroy(Request $request): RedirectResponse
    {
        $guard = collect(['admin', 'mitra', 'alumni'])
            ->first(fn (string $guard) => Auth::guard($guard)->check());

        if ($guard) {
            Auth::guard($guard)->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
