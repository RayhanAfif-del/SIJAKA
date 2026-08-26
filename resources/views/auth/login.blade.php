<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'SIJAKA') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen overflow-x-hidden font-sans antialiased bg-slate-950 text-white">
    <div class="min-h-screen grid lg:grid-cols-[1.15fr_0.85fr]">
        <section class="relative overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(14,165,233,0.35),_transparent_32%),radial-gradient(circle_at_bottom_right,_rgba(59,130,246,0.28),_transparent_28%),linear-gradient(135deg,_#020617_0%,_#0f172a_48%,_#1e3a8a_100%)] px-6 py-8 sm:px-10 lg:px-12 lg:py-10 flex flex-col justify-between">

            <div class="relative z-10 max-w-xl pt-10 lg:pt-0">
                <h1 class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight text-white">
                    Kelola layanan karier dengan tampilan yang lebih nyaman.
                </h1>
                <p class="mt-5 max-w-lg text-sm sm:text-base leading-7 text-slate-300">
                    Masuk untuk mengelola lowongan, profil mitra, artikel, galeri, dan pengaturan web utama dari satu dashboard yang rapi.
                </p><br>
            </div>

            <div class="relative z-10 mt-10 lg:mt-0">
                <div class="rounded-[2rem] border border-white/10 bg-white/10 backdrop-blur-md shadow-2xl overflow-hidden">
                    <svg viewBox="0 0 960 620" class="block w-full h-[300px] sm:h-[360px] lg:h-[420px]" role="img" aria-labelledby="loginArtTitle loginArtDesc" xmlns="http://www.w3.org/2000/svg">
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

        <section class="relative flex items-center justify-center px-4 py-10 sm:px-6 lg:px-10 bg-[radial-gradient(circle_at_top_right,_rgba(59,130,246,0.10),_transparent_30%),linear-gradient(to_bottom,_#f8fafc,_#eef2ff_65%,_#f8fafc)]">
            <div class="absolute inset-0 bg-[linear-gradient(135deg,rgba(255,255,255,0.65),rgba(255,255,255,0.95))]"></div>

            <div class="relative z-10 w-full max-w-lg">
                <div class="dashboard-panel p-6 sm:p-8 lg:p-10 border border-white/70">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-lg">SI</span>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Masuk ke aplikasi</p>
                            <h2 class="text-2xl font-bold text-slate-900">Login SIJAKA</h2>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="mb-5 rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" x-data="{ role: 'admin' }" class="space-y-5">
                        @csrf
                        <input type="hidden" name="role" x-model="role">

                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-1">
                            <div class="grid grid-cols-2 gap-1">
                                <button type="button" @click="role = 'admin'"
                                    :class="role === 'admin' ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-700'"
                                    class="rounded-xl px-4 py-2.5 text-sm font-semibold transition">
                                    Admin
                                </button>
                                <button type="button" @click="role = 'mitra'"
                                    :class="role === 'mitra' ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-700'"
                                    class="rounded-xl px-4 py-2.5 text-sm font-semibold transition">
                                    Mitra
                                </button>
                            </div>
                        </div>

                        <div>
                            <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@perusahaan.com">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="mb-1.5 flex items-center justify-between gap-3">
                                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 hover:underline">
                                        Lupa password?
                                    </a>
                                @endif
                            </div>
                            <input id="password" type="password" name="password" required>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <label for="remember_me" class="flex items-center gap-2 text-sm text-slate-600">
                                <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                Ingat saya
                            </label>
                            <span class="text-xs text-slate-400" x-text="role === 'admin' ? 'Mode Admin' : 'Mode Mitra'"></span>
                        </div>

                        <button type="submit" class="w-full rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20">
                            Masuk
                        </button>
                    </form>

                    <div class="mt-8 flex items-center justify-between text-sm">
                        <a href="{{ route('home') }}" class="text-slate-500 hover:text-blue-600 transition">
                            &larr; Kembali ke beranda
                        </a>
                        <span class="text-slate-400">SIJAKA</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
