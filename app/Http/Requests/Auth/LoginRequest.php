<?php

namespace App\Http\Requests\Auth;

use App\Models\Alumni;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $role = $this->input('role');

        return [
            'role' => ['required', 'in:mitra,alumni'],
            'email' => $role === 'mitra'
                ? ['required', 'string', 'email']
                : ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    // Coba autentikasi ke guard sesuai role yang dipilih pada tab
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $guard = $this->string('role')->value(); // 'mitra' | 'alumni'
        $loginInput = trim($this->string('email')->value());
        $password = $this->string('password')->value();
        $remember = $this->boolean('remember');

        $authenticated = false;

        if ($guard === 'alumni') {
            // Bisa login dengan email atau NIS
            $alumnus = Alumni::where('email', $loginInput)
                ->orWhere('nis', $loginInput)
                ->first();

            if ($alumnus && $alumnus->password && Hash::check($password, $alumnus->password)) {
                Auth::guard('alumni')->login($alumnus, $remember);
                $authenticated = true;
            }
        } else {
            $authenticated = Auth::guard($guard)->attempt(
                ['email' => $loginInput, 'password' => $password],
                $remember
            );
        }

        if (! $authenticated) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
