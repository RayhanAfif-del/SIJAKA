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

        return $role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('mitra.dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        // Logout dari guard mana pun yang sedang aktif (admin atau mitra)
        $guard = Auth::guard('admin')->check() ? 'admin' : 'mitra';

        Auth::guard($guard)->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
