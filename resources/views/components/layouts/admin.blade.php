<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard Admin' }} - SIJAKA</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @php
        $pengaturanLayout = \App\Models\PengaturanWebsite::singleton();
        $siteIconUrl = $pengaturanLayout->site_icon
            ? \Illuminate\Support\Facades\Storage::url($pengaturanLayout->site_icon)
            : asset('favicon.ico');
    @endphp
    <link rel="icon" href="{{ $siteIconUrl }}">
    
    {{-- Custom Scrollbar untuk Sidebar --}}
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-900" x-data="{ sidebarOpen: false }">

    <div class="flex min-h-screen">

        {{-- Mobile Backdrop Overlay --}}
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-20 lg:hidden">
        </div>

        {{-- Sidebar --}}
        <aside class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-950 border-r border-white/10 flex flex-col transform transition-transform duration-300 ease-in-out lg:translate-x-0"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            {{-- Logo Area --}}
            <div class="h-16 flex items-center gap-3 px-5 border-b border-white/10 bg-white/5 shrink-0">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-white font-bold text-xs shadow-lg shadow-blue-500/20 overflow-hidden shrink-0 ring-1 ring-white/10">
                    @if ($pengaturanLayout->site_icon)
                        <img src="{{ $siteIconUrl }}" alt="Icon SIJAKA" class="w-full h-full object-cover">
                    @else
                        SI
                    @endif
                </div>
                <div class="min-w-0">
                    <p class="font-bold text-sm text-white leading-tight tracking-wide">SIJAKA</p>
                    <p class="text-[10px] text-slate-400 leading-tight truncate">Sistem Informasi Jejaring Karier</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto custom-scrollbar p-3 space-y-1">
                <x-admin.nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Dashboard
                </x-admin.nav-link>

                <x-admin.nav-link href="{{ route('admin.website') }}" :active="false" target="_blank" rel="noopener noreferrer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat Website
                </x-admin.nav-link>

                <div class="pt-4 pb-1">
                    <p class="px-3 text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-500">Pengaturan</p>
                </div>
                <x-admin.nav-link href="{{ route('admin.pengaturan-beranda.edit') }}" :active="request()->routeIs('admin.pengaturan-beranda.*')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.profil-bkk.edit') }}" :active="request()->routeIs('admin.profil-bkk.*')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Profil BKK
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.kontak.edit') }}" :active="request()->routeIs('admin.kontak.*')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Kontak
                </x-admin.nav-link>

                <div class="pt-4 pb-1">
                    <p class="px-3 text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-500">Kelola Data</p>
                </div>
                <x-admin.nav-link href="{{ route('admin.struktur-organisasi.index') }}" :active="request()->routeIs('admin.struktur-organisasi.*')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Struktur Organisasi
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.mitra.index') }}" :active="request()->routeIs('admin.mitra.*')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Mitra Perusahaan
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.lowongan.index') }}" :active="request()->routeIs('admin.lowongan.*')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Lowongan
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.artikel.index') }}" :active="request()->routeIs('admin.artikel.*')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    Artikel
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.galeri.index') }}" :active="request()->routeIs('admin.galeri.*')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Galeri
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.alumni.index') }}" :active="request()->routeIs('admin.alumni.*')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                    Alumni
                </x-admin.nav-link>

                <div class="pt-4 pb-1">
                    <p class="px-3 text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-500">Lainnya</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-slate-300 hover:bg-red-500/10 hover:text-red-400 transition-all duration-200 group">
                        <svg class="w-5 h-5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Keluar
                    </button>
                </form>
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 lg:ml-64 min-w-0 flex flex-col">
            
            {{-- Top Header --}}
            <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200/80 flex items-center justify-between px-4 sm:px-6 sticky top-0 z-10">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 -ml-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div class="hidden sm:block">
                        <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-400">Dashboard</p>
                        <p class="text-sm font-semibold text-slate-800 leading-tight">{{ $title ?? 'Dashboard Admin' }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 sm:gap-4">
                    <a href="{{ route('admin.website') }}" target="_blank" rel="noopener noreferrer" class="hidden sm:inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-medium text-slate-600 shadow-sm transition hover:border-blue-300 hover:text-blue-600 hover:shadow">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5M12 12L21 3m0 0h-6m6 0v6"/>
                        </svg>
                        Website
                    </a>
                    
                    <div class="h-6 w-px bg-slate-200 hidden sm:block"></div>

                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-slate-800 leading-tight">{{ auth('admin')->user()->name }}</p>
                            <p class="text-[11px] text-slate-500">Administrator</p>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-white text-sm font-bold shadow-md shadow-blue-500/20 ring-2 ring-white">
                            {{ strtoupper(substr(auth('admin')->user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if (session('status'))
                    <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 text-sm border border-emerald-100 shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 px-4 py-3 rounded-xl bg-red-50 text-red-700 text-sm border border-red-100 shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="max-w-[1440px] mx-auto animate-fade-in">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>