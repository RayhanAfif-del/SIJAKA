<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - SIJAKA</title>

    @php
        $pengaturanLogin = \App\Models\PengaturanWebsite::singleton();
        $siteIconUrl = $pengaturanLogin->site_icon
            ? \Illuminate\Support\Facades\Storage::url($pengaturanLogin->site_icon)
            : asset('logo.png');
    @endphp

    <link rel="icon" href="{{ $siteIconUrl }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen overflow-x-hidden font-sans antialiased bg-slate-950 text-white">
    <div class="min-h-screen grid lg:grid-cols-[1.15fr_0.85fr]">
        
        {{-- Left Side: Branding & Illustration --}}
        <section class="relative overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(14,165,233,0.35),_transparent_32%),radial-gradient(circle_at_bottom_right,_rgba(59,130,246,0.28),_transparent_28%),linear-gradient(135deg,_#020617_0%,_#0f172a_48%,_#1e3a8a_100%)] px-6 py-8 sm:px-10 lg:px-12 lg:py-10 flex flex-col justify-between">
            <div class="relative z-10 max-w-xl pt-10 lg:pt-0">
                <h1 class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight text-white tracking-tight">
                    Kelola layanan karier dengan tampilan yang lebih nyaman.
                </h1>
                <p class="mt-5 max-w-lg text-sm sm:text-base leading-7 text-slate-300">
                    Masuk untuk mengelola lowongan, profil mitra, artikel, galeri, dan pengaturan web utama dari satu dashboard yang rapi.
                </p>
            </div>

            <div class="relative z-10 mt-10 lg:mt-0 hidden lg:block">
                <div class="rounded-[2rem] border border-white/10 bg-white/5 backdrop-blur-md shadow-2xl overflow-hidden ring-1 ring-white/10">
                    <svg viewBox="0 0 960 620" class="block w-full h-[420px]" role="img" aria-labelledby="loginArtTitle loginArtDesc" xmlns="http://www.w3.org/2000/svg">
                        <title id="loginArtTitle">Ilustrasi dashboard SIJAKA</title>
                        <desc id="loginArtDesc">Visual dummy modern bernuansa biru untuk halaman login.</desc>
                        <defs>
                            <linearGradient id="lg1" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0%" stop-color="#38bdf8" />
                                <stop offset="100%" stop-color="#1d4ed8" />
                            </linearGradient>
                            <linearGradient id="lg2" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#ffffff" stop-opacity="0.95" />
                                <stop offset="100%" stop-color="#dbeafe" stop-opacity="0.9" />
                            </linearGradient>
                        </defs>
                        <rect width="960" height="620" rx="40" fill="#081120" />
                        <circle cx="790" cy="110" r="120" fill="#38bdf8" fill-opacity="0.18" />
                        <circle cx="150" cy="500" r="150" fill="#2563eb" fill-opacity="0.2" />
                        <path d="M0 455C140 360 255 325 395 335C533 344 638 417 748 373C825 342 886 294 960 270V620H0V455Z" fill="url(#lg1)" fill-opacity="0.45" />
                        <rect x="110" y="78" width="740" height="420" rx="30" fill="url(#lg2)" />
                        <rect x="150" y="118" width="220" height="18" rx="9" fill="#bfdbfe" />
                        <rect x="150" y="150" width="340" height="20" rx="10" fill="#60a5fa" />
                        <rect x="150" y="198" width="470" height="14" rx="7" fill="#dbeafe" />
                        <rect x="150" y="228" width="420" height="14" rx="7" fill="#dbeafe" />
                        <rect x="150" y="258" width="360" height="14" rx="7" fill="#dbeafe" />
                        <rect x="150" y="312" width="210" height="120" rx="22" fill="#eff6ff" />
                        <rect x="386" y="312" width="210" height="120" rx="22" fill="#fef3c7" />
                        <rect x="622" y="312" width="180" height="120" rx="22" fill="#e0f2fe" />
                        <circle cx="244" cy="370" r="30" fill="#2563eb" />
                        <circle cx="491" cy="370" r="30" fill="#f59e0b" />
                        <circle cx="712" cy="370" r="30" fill="#0ea5e9" />
                        <path d="M235 370L243 378L258 361" stroke="white" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M482 370L490 378L505 361" stroke="white" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M703 370L711 378L726 361" stroke="white" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" />
                        <rect x="150" y="474" width="280" height="14" rx="7" fill="#bfdbfe" />
                        <rect x="150" y="500" width="200" height="12" rx="6" fill="#dbeafe" />
                        <rect x="150" y="528" width="140" height="12" rx="6" fill="#dbeafe" />
                    </svg>
                </div>
            </div>
        </section>

        {{-- Right Side: Login Form --}}
        <section class="relative flex items-center justify-center px-4 py-10 sm:px-6 lg:px-10 bg-slate-50">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(59,130,246,0.08),_transparent_40%)]"></div>

            <div class="relative z-10 w-full max-w-md">
                {{-- Card Form --}}
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 p-6 sm:p-8 lg:p-10">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center overflow-hidden bg-transparent">
                            <x-application-logo class="w-full h-full object-contain" />
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400 font-semibold">Masuk ke aplikasi</p>
                            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Login SIJAKA</h2>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="mb-6 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 flex items-center gap-2">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" x-data="{ role: 'admin' }" class="space-y-5">
                        @csrf
                        <input type="hidden" name="role" x-model="role">

                        {{-- Role Toggle --}}
                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-1">
                            <div class="grid grid-cols-3 gap-1">
                                <button type="button" @click="role = 'admin'"
                                    :class="role === 'admin' ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-100'"
                                    class="rounded-lg px-4 py-2.5 text-sm font-semibold transition-all duration-200">
                                    Admin
                                </button>
                                <button type="button" @click="role = 'mitra'"
                                    :class="role === 'mitra' ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-100'"
                                    class="rounded-lg px-4 py-2.5 text-sm font-semibold transition-all duration-200">
                                    Mitra Perusahaan
                                </button>
                                <button type="button" @click="role = 'alumni'"
                                    :class="role === 'alumni' ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-100'"
                                    class="rounded-lg px-2 py-2.5 text-sm font-semibold transition-all duration-200">
                                    Alumni
                                </button>
                            </div>
                        </div>

                        {{-- Email Input --}}
                        <div>
                            <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@perusahaan.com"
                                class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition placeholder:text-slate-400">
                            @error('email')
                                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password Input --}}
                        <div>
                            <div class="mb-1.5 flex items-center justify-between gap-3">
                                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-xs font-medium text-blue-600 hover:text-blue-700 hover:underline transition">
                                        Lupa password?
                                    </a>
                                @endif
                            </div>
                            <input id="password" type="password" name="password" required placeholder="••••••••"
                                class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition placeholder:text-slate-400">
                            @error('password')
                                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Remember Me & Mode Indicator --}}
                        <div class="flex items-center justify-between gap-4">
                            <label for="remember_me" class="flex items-center gap-2 text-sm text-slate-600 cursor-pointer">
                                <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-500/20 transition cursor-pointer">
                                Ingat saya
                            </label>
                            <span class="text-xs font-medium text-slate-400 bg-slate-100 px-2 py-1 rounded-md" x-text="role === 'admin' ? 'Mode: Admin' : (role === 'mitra' ? 'Mode: Mitra' : 'Mode: Alumni')"></span>
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" class="w-full rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition-all duration-200 hover:bg-slate-800 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-slate-900/20 active:scale-[0.98]">
                            Masuk
                        </button>
                    </form>


                    <div class="mt-8 flex items-center justify-between text-sm pt-6 border-t border-slate-100">
                        <a href="{{ route('home') }}" class="text-slate-500 hover:text-blue-600 transition flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Kembali ke beranda
                        </a>
                        <span class="text-slate-400 font-medium">SIJAKA</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
