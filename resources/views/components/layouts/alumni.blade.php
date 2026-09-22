<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard Alumni' }} - SIJAKA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $pengaturanLayout = \App\Models\PengaturanWebsite::singleton();
        $siteIconUrl = $pengaturanLayout->site_icon
            ? \Illuminate\Support\Facades\Storage::url($pengaturanLayout->site_icon)
            : asset('favicon.ico');
    @endphp
    <link rel="icon" href="{{ $siteIconUrl }}">
    
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 9999px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.2); }
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-900" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="sidebarOpen = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-20 lg:hidden"></div>

        <aside class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-950 border-r border-white/10 flex flex-col transform transition-transform duration-300 ease-in-out lg:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="h-16 flex items-center gap-3 px-5 border-b border-white/10 bg-white/5 shrink-0">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center overflow-hidden shrink-0 bg-transparent">
                    <x-application-logo class="w-full h-full object-contain" />
                </div>
                <div class="min-w-0">
                    <p class="font-bold text-sm text-white leading-tight tracking-wide">SIJAKA</p>
                    <p class="text-[10px] text-slate-400 leading-tight truncate">Portal Alumni</p>
                </div>
            </div>

            <nav class="flex-1 overflow-y-auto custom-scrollbar p-3 space-y-1">
                <div class="pt-4 pb-1"><p class="px-3 text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-500">Menu Utama</p></div>
                <x-admin.nav-link href="{{ route('alumni.dashboard') }}" :active="request()->routeIs('alumni.dashboard') || request()->routeIs('alumni.profile.*')">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Dashboard & Profil Saya
                </x-admin.nav-link>

                <div class="pt-4 pb-1"><p class="px-3 text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-500">Layanan Karir</p></div>
                <a href="{{ route('lowongan.index') }}" target="_blank" class="group flex min-h-11 items-center justify-between px-3 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-white/10 hover:text-white transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0 text-slate-400 group-hover:text-blue-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Cari Lowongan</span>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-500 group-hover:text-slate-300 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>

                <a href="{{ route('home') }}" target="_blank" class="group flex min-h-11 items-center justify-between px-3 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-white/10 hover:text-white transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0 text-slate-400 group-hover:text-indigo-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Beranda SIJAKA</span>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-500 group-hover:text-slate-300 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>

                <div class="pt-4 pb-1 mt-auto"><p class="px-3 text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-500">Akun</p></div>
                <form method="POST" action="{{ route('alumni.logout') }}">
                    @csrf
                    <button type="submit" class="group w-full flex min-h-11 items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-red-500/10 hover:text-red-400 transition-all duration-200">
                        <svg class="w-5 h-5 shrink-0 text-slate-400 group-hover:text-red-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </nav>
        </aside>

        <div class="flex-1 lg:ml-64 min-w-0 flex flex-col">
            <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200/80 flex items-center justify-between px-4 sm:px-6 sticky top-0 z-10">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden -ml-2 inline-flex h-11 w-11 items-center justify-center rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition" aria-label="Buka menu navigasi" :aria-expanded="sidebarOpen">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div class="hidden sm:block"><p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-400">Dashboard</p><p class="text-sm font-semibold text-slate-800 leading-tight">{{ $title ?? 'Dashboard Alumni' }}</p></div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block"><p class="text-sm font-semibold text-slate-800 leading-tight truncate max-w-[180px]" title="{{ auth('alumni')->user()->nama }}">{{ auth('alumni')->user()->nama }}</p><p class="text-[11px] text-slate-500">Alumni</p></div>
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-white text-sm font-bold shadow-md shadow-blue-500/20 ring-2 ring-white shrink-0 overflow-hidden">
                        @if (auth('alumni')->user()->foto_path)
                            <img src="{{ Storage::url(auth('alumni')->user()->foto_path) }}" alt="Foto profil" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr(auth('alumni')->user()->nama, 0, 1)) }}
                        @endif
                    </div>
                </div>
            </header>

            <main class="flex-1 p-3.5 sm:p-6 lg:p-8">
                @if (session('status') || session('success'))
                    <div class="mb-6 px-4 py-3.5 rounded-xl bg-emerald-50 text-emerald-800 text-sm border border-emerald-200/80 shadow-sm flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('status') ?? session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-6 px-4 py-3.5 rounded-xl bg-red-50 text-red-800 text-sm border border-red-200/80 shadow-sm flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
                <div class="max-w-[1440px] mx-auto">{{ $slot }}</div>
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
