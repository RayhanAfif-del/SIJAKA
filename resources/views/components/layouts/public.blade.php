<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'SIJAKA' }} - SMK N 1 Bangsri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800" x-data="{ mobileMenu: false }">

    @php
        $kontakLayout = \App\Models\Kontak::singleton();
        $pengaturanLayout = \App\Models\PengaturanWebsite::singleton();
    @endphp

    {{-- Top bar --}}
    <div class="bg-blue-950 text-blue-100 text-xs">
        <div class="max-w-7xl mx-auto px-4 py-2 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
            <div class="flex flex-wrap items-center gap-x-5 gap-y-1">
                @if ($kontakLayout->alamat)
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $kontakLayout->alamat }}
                    </span>
                @endif
                @if ($kontakLayout->email)
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        {{ $kontakLayout->email }}
                    </span>
                @endif
                @if ($kontakLayout->telepon)
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        {{ $kontakLayout->telepon }}
                    </span>
                @endif
            </div>
<div class="flex items-center gap-3">
                @if ($kontakLayout->facebook)
                    <a href="{{ $kontakLayout->facebook }}" target="_blank" class="hover:text-white" aria-label="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                @endif
                @if ($kontakLayout->instagram)
                    <a href="{{ $kontakLayout->instagram }}" target="_blank" class="hover:text-white" aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                @endif
                @if ($kontakLayout->youtube)
                    <a href="{{ $kontakLayout->youtube }}" target="_blank" class="hover:text-white" aria-label="YouTube">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Navbar --}}
    <header class="bg-white border-b border-gray-100 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-full bg-blue-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 20.055 12.083 12.083 0 015.84 10.578L12 14z"/></svg>
                </div>
                <div class="leading-tight">
                    <p class="font-bold text-blue-900 text-base">{{ $pengaturanLayout->site_name }}</p>
                    <p class="text-xs text-gray-400">{{ $pengaturanLayout->site_tagline }}</p>
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-6 text-sm font-medium text-gray-600">
                <a href="{{ route('home') }}" class="pb-1 border-b-2 {{ request()->routeIs('home') ? 'text-blue-600 border-blue-600' : 'border-transparent hover:text-blue-600' }}">Beranda</a>
                <a href="{{ route('profil.index') }}" class="pb-1 border-b-2 {{ request()->routeIs('profil.*') ? 'text-blue-600 border-blue-600' : 'border-transparent hover:text-blue-600' }}">Profil SIJAKA</a>
                <a href="{{ route('lowongan.index') }}" class="pb-1 border-b-2 {{ request()->routeIs('lowongan.*') ? 'text-blue-600 border-blue-600' : 'border-transparent hover:text-blue-600' }}">Lowongan</a>
                <a href="{{ route('artikel.index') }}" class="pb-1 border-b-2 {{ request()->routeIs('artikel.*') ? 'text-blue-600 border-blue-600' : 'border-transparent hover:text-blue-600' }}">Artikel</a>
                <a href="{{ route('galeri.index') }}" class="pb-1 border-b-2 {{ request()->routeIs('galeri.*') ? 'text-blue-600 border-blue-600' : 'border-transparent hover:text-blue-600' }}">Galeri</a>
                <a href="{{ route('statistik.index') }}" class="pb-1 border-b-2 {{ request()->routeIs('statistik.*') ? 'text-blue-600 border-blue-600' : 'border-transparent hover:text-blue-600' }}">Statistik</a>
                <a href="{{ route('kontak.index') }}" class="pb-1 border-b-2 {{ request()->routeIs('kontak.*') ? 'text-blue-600 border-blue-600' : 'border-transparent hover:text-blue-600' }}">Kontak</a>
            </nav>

            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Masuk Admin
                </a>
                <button class="lg:hidden text-gray-500" @click="mobileMenu = !mobileMenu">&#9776;</button>
            </div>
        </div>

        <div x-show="mobileMenu" x-cloak class="lg:hidden border-t border-gray-100 px-4 py-3 space-y-2 text-sm">
            <a href="{{ route('home') }}" class="block py-1 text-gray-600">Beranda</a>
            <a href="{{ route('profil.index') }}" class="block py-1 text-gray-600">Profil SIJAKA</a>
            <a href="{{ route('lowongan.index') }}" class="block py-1 text-gray-600">Lowongan</a>
            <a href="{{ route('artikel.index') }}" class="block py-1 text-gray-600">Artikel</a>
            <a href="{{ route('galeri.index') }}" class="block py-1 text-gray-600">Galeri</a>
            <a href="{{ route('statistik.index') }}" class="block py-1 text-gray-600">Statistik</a>
            <a href="{{ route('kontak.index') }}" class="block py-1 text-gray-600">Kontak</a>
            <a href="{{ route('login') }}" class="block py-1 text-blue-600 font-medium">Masuk Admin</a>
        </div>
    </header>

    @if (session('status'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="px-4 py-3 rounded-lg bg-green-50 text-green-700 text-sm border border-green-100">
                {{ session('status') }}
            </div>
        </div>
    @endif

    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-blue-950 text-blue-100 mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-sm">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-white leading-tight">{{ $pengaturanLayout->site_name }}</p>
                        <p class="text-xs text-blue-300">{{ $pengaturanLayout->site_tagline }}</p>
                    </div>
                </div>
                <p class="text-blue-300 leading-relaxed">{{ $pengaturanLayout->footer_text }}</p>
            </div>

            <div>
                <p class="font-semibold text-white mb-3">Menu</p>
                <ul class="space-y-2 text-blue-300">
                    <li><a href="{{ route('home') }}" class="hover:text-white">Beranda</a></li>
                    <li><a href="{{ route('profil.index') }}" class="hover:text-white">Profil BKK</a></li>
                    <li><a href="{{ route('lowongan.index') }}" class="hover:text-white">Lowongan</a></li>
                    <li><a href="{{ route('artikel.index') }}" class="hover:text-white">Artikel</a></li>
                    <li><a href="{{ route('galeri.index') }}" class="hover:text-white">Galeri</a></li>
                    <li><a href="{{ route('statistik.index') }}" class="hover:text-white">Statistik</a></li>
                    <li><a href="{{ route('kontak.index') }}" class="hover:text-white">Kontak</a></li>
                </ul>
            </div>

            <div>
                <p class="font-semibold text-white mb-3">Profil SIJAKA</p>
                <ul class="space-y-2 text-blue-300">
                    <li><a href="{{ route('profil.index') }}" class="hover:text-white">Tentang SIJAKA</a></li>
                    <li><a href="{{ route('struktur-organisasi.index') }}" class="hover:text-white">Struktur Organisasi</a></li>
                    <li><a href="{{ route('lowongan.index') }}" class="hover:text-white">Mitra Kerja</a></li>
                    <li><a href="{{ route('profil.index') }}" class="hover:text-white">Visi &amp; Misi</a></li>
                </ul>
            </div>

            <div>
                <p class="font-semibold text-white mb-3">Kontak Kami</p>
                <ul class="space-y-2 text-blue-300">
                    @if ($kontakLayout->alamat)<li>{{ $kontakLayout->alamat }}</li>@endif
                    @if ($kontakLayout->telepon)<li>{{ $kontakLayout->telepon }}</li>@endif
                    @if ($kontakLayout->email)<li>{{ $kontakLayout->email }}</li>@endif
                    @if ($kontakLayout->jam_operasional)<li>{{ $kontakLayout->jam_operasional }}</li>@endif
                </ul>
            </div>
        </div>
        <div class="border-t border-blue-900 py-4 text-center text-xs text-blue-400">
            &copy; {{ now()->year }} {{ $pengaturanLayout->site_name }}. All rights reserved.
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
