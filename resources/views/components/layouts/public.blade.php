<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'SIJAKA' }} - SMK N 1 Bangsri</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @php
        $kontakLayout = \App\Models\Kontak::singleton();
        $pengaturanLayout = \App\Models\PengaturanWebsite::singleton();
        $showLogin = ! auth('admin')->check() && ! auth('mitra')->check();
        $siteIconUrl = $pengaturanLayout->site_icon
            ? \Illuminate\Support\Facades\Storage::url($pengaturanLayout->site_icon)
            : asset('favicon.ico');
    @endphp
    <link rel="icon" href="{{ $siteIconUrl }}">

    {{-- AOS Animation Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    {{-- TAMBAHKAN BARIS INI AGAR CSS DARI BERANDA BISA DIBACA --}}
    @stack('styles')
    
</head>

<body class="bg-slate-50 font-sans antialiased text-slate-800 flex flex-col min-h-screen" x-data="{ mobileMenu: false }">

    {{-- Top Bar --}}
    <div class="bg-slate-900 text-slate-300 text-xs hidden sm:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex items-center justify-between">
            <div class="flex items-center gap-4">
                @if ($kontakLayout->alamat)
                    <span class="flex items-center gap-1.5 max-w-[28rem] truncate">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="truncate">{{ $kontakLayout->alamat }}</span>
                    </span>
                @endif
                @if ($kontakLayout->email)
                    <a href="mailto:{{ $kontakLayout->email }}" class="flex items-center gap-1.5 hover:text-white transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        {{ $kontakLayout->email }}
                    </a>
                @endif
                @if ($kontakLayout->telepon)
                    <a href="tel:{{ $kontakLayout->telepon }}" class="flex items-center gap-1.5 hover:text-white transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        {{ $kontakLayout->telepon }}
                    </a>
                @endif
            </div>
            <div class="flex items-center gap-2">
                @if ($kontakLayout->facebook)
                    <a href="{{ $kontakLayout->facebook }}" target="_blank" class="w-7 h-7 rounded-full bg-white/5 hover:bg-blue-600 flex items-center justify-center transition" aria-label="Facebook">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                @endif
                @if ($kontakLayout->instagram)
                    <a href="{{ $kontakLayout->instagram }}" target="_blank" class="w-7 h-7 rounded-full bg-white/5 hover:bg-pink-600 flex items-center justify-center transition" aria-label="Instagram">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                @endif
                @if ($kontakLayout->youtube)
                    <a href="{{ $kontakLayout->youtube }}" target="_blank" class="w-7 h-7 rounded-full bg-white/5 hover:bg-red-600 flex items-center justify-center transition" aria-label="YouTube">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Navbar --}}
    <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center flex-shrink-0 overflow-hidden shadow-md shadow-blue-500/20 group-hover:shadow-lg transition">
                        @if ($pengaturanLayout->site_icon)
                            <img src="{{ $siteIconUrl }}" alt="Icon SIJAKA" class="w-full h-full object-cover">
                        @else
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 20.055 12.083 12.083 0 015.84 10.578L12 14z"/></svg>
                        @endif
                    </div>
                    <div class="leading-tight hidden sm:block">
                        <p class="font-bold text-slate-900 text-base tracking-tight">{{ $pengaturanLayout->site_name ?? 'SIJAKA' }}</p>
                        <p class="text-[11px] text-slate-500 font-medium">{{ $pengaturanLayout->site_tagline ?? 'Sistem Informasi Jejaring Karier' }}</p>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <nav class="hidden lg:flex items-center gap-1">
                    @php
                        $navLinks = [
                            ['route' => 'home', 'label' => 'Beranda'],
                            ['route' => 'profil.index', 'label' => 'Profil'],
                            ['route' => 'lowongan.index', 'label' => 'Lowongan'],
                            ['route' => 'artikel.index', 'label' => 'Artikel'],
                            ['route' => 'galeri.index', 'label' => 'Galeri'],
                            ['route' => 'statistik.index', 'label' => 'Statistik'],
                            ['route' => 'kontak.index', 'label' => 'Kontak'],
                        ];
                    @endphp
                    @foreach ($navLinks as $link)
                        <a href="{{ route($link['route']) }}" 
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs($link['route'] . '*') ? 'text-blue-600 bg-blue-50' : 'text-slate-600 hover:text-blue-600 hover:bg-slate-50' }}">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </nav>

                {{-- Right Actions --}}
                <div class="flex items-center gap-3">
                    @if ($showLogin)
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium px-4 py-2 rounded-lg transition shadow-sm hover:shadow">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                            Masuk
                        </a>
                    @endif
                    
                    {{-- Mobile Menu Button --}}
                    <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition">
                        <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="mobileMenu" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenu" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             x-cloak
             class="lg:hidden border-t border-slate-100 bg-white absolute w-full left-0 shadow-lg">
            <div class="px-4 py-3 space-y-1">
                @foreach ($navLinks as $link)
                    <a href="{{ route($link['route']) }}" 
                       @click="mobileMenu = false"
                       class="block px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs($link['route'] . '*') ? 'text-blue-600 bg-blue-50' : 'text-slate-600 hover:bg-slate-50' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
                @if ($showLogin)
                    <div class="pt-2 mt-2 border-t border-slate-100">
                        <a href="{{ route('login') }}" @click="mobileMenu = false" class="block w-full text-center px-3 py-2.5 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition">
                            Masuk Dashboard
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </header>

    {{-- Flash Messages --}}
    @if (session('status'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 text-sm border border-emerald-100 shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('status') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="px-4 py-3 rounded-xl bg-red-50 text-red-700 text-sm border border-red-100 shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="flex-grow">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-slate-900 text-slate-300 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                {{-- Brand --}}
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center overflow-hidden shadow-md">
                            @if ($pengaturanLayout->site_icon)
                                <img src="{{ $siteIconUrl }}" alt="Icon SIJAKA" class="w-full h-full object-cover">
                            @else
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/></svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-bold text-white text-base leading-tight">{{ $pengaturanLayout->site_name ?? 'SIJAKA' }}</p>
                            <p class="text-xs text-slate-400">{{ $pengaturanLayout->site_tagline ?? 'Sistem Informasi Jejaring Karier' }}</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed mb-4">
                        {{ $pengaturanLayout->footer_text ?? 'Membangun jejaring karier yang kuat untuk masa depan alumni yang lebih cerah.' }}
                    </p>
                    <div class="flex items-center gap-2">
                        @if ($kontakLayout->facebook)
                            <a href="{{ $kontakLayout->facebook }}" target="_blank" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-blue-600 flex items-center justify-center transition" aria-label="Facebook">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        @endif
                        @if ($kontakLayout->instagram)
                            <a href="{{ $kontakLayout->instagram }}" target="_blank" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-pink-600 flex items-center justify-center transition" aria-label="Instagram">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </a>
                        @endif
                        @if ($kontakLayout->youtube)
                            <a href="{{ $kontakLayout->youtube }}" target="_blank" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-red-600 flex items-center justify-center transition" aria-label="YouTube">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <p class="font-semibold text-white mb-4 text-sm uppercase tracking-wider">Menu Utama</p>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Beranda</a></li>
                        <li><a href="{{ route('profil.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Profil BKK</a></li>
                        <li><a href="{{ route('lowongan.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Lowongan Kerja</a></li>
                        <li><a href="{{ route('artikel.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Artikel & Tips</a></li>
                        <li><a href="{{ route('galeri.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Galeri Kegiatan</a></li>
                    </ul>
                </div>

                {{-- Informasi --}}
                <div>
                    <p class="font-semibold text-white mb-4 text-sm uppercase tracking-wider">Informasi</p>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('struktur-organisasi.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Struktur Organisasi</a></li>
                        <li><a href="{{ route('statistik.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Statistik Alumni</a></li>
                        <li><a href="{{ route('kontak.index') }}" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Hubungi Kami</a></li>
                    </ul>
                </div>

                {{-- Contact Info --}}
                <div>
                    <p class="font-semibold text-white mb-4 text-sm uppercase tracking-wider">Kontak Kami</p>
                    <ul class="space-y-3 text-sm">
                        @if ($kontakLayout->alamat)
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-blue-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>{{ $kontakLayout->alamat }}</span>
                            </li>
                        @endif
                        @if ($kontakLayout->telepon)
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span>{{ $kontakLayout->telepon }}</span>
                            </li>
                        @endif
                        @if ($kontakLayout->email)
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span>{{ $kontakLayout->email }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        
        {{-- Copyright --}}
        <div class="border-t border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                <p>&copy; {{ now()->year }} {{ $pengaturanLayout->site_name ?? 'SIJAKA' }}. All rights reserved.</p>
                <p>Dikembangkan dengan ❤️ untuk SMK N 1 Bangsri</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
    </script>
</body>
</html>
