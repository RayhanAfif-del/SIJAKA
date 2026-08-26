<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard Admin' }} - SIJAKA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="dashboard-shell font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-950/95 text-white flex-shrink-0 fixed inset-y-0 left-0 z-30 transform transition-transform lg:translate-x-0 border-r border-white/10 backdrop-blur-xl"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="h-16 flex items-center gap-3 px-5 border-b border-white/10 bg-white/5">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-white font-bold text-sm shadow-lg">SI</div>
                <div>
                    <p class="font-semibold leading-tight tracking-wide">SIJAKA</p>
                    <p class="text-[11px] text-slate-300 leading-tight">Sistem Informasi Jejaring Karier</p>
                </div>
            </div>

            <nav class="p-3 space-y-1 overflow-y-auto" style="max-height: calc(100vh - 4rem)">
                <x-admin.nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                    Dashboard
                </x-admin.nav-link>

                <x-admin.nav-link href="{{ route('admin.website') }}" :active="request()->routeIs('admin.website')" target="_blank" rel="noopener noreferrer">
                    Lihat Website
                </x-admin.nav-link>

                <p class="px-4 pt-4 pb-1 text-[11px] uppercase tracking-[0.2em] text-slate-400">Pengaturan</p>
                <x-admin.nav-link href="{{ route('admin.pengaturan-beranda.edit') }}" :active="request()->routeIs('admin.pengaturan-beranda.*')">
                    Beranda
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.profil-bkk.edit') }}" :active="request()->routeIs('admin.profil-bkk.*')">
                    Profil BKK
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.kontak.edit') }}" :active="request()->routeIs('admin.kontak.*')">
                    Kontak
                </x-admin.nav-link>

                <p class="px-4 pt-4 pb-1 text-[11px] uppercase tracking-[0.2em] text-slate-400">Kelola Data</p>
                <x-admin.nav-link href="{{ route('admin.struktur-organisasi.index') }}" :active="request()->routeIs('admin.struktur-organisasi.*')">
                    Struktur Organisasi
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.mitra.index') }}" :active="request()->routeIs('admin.mitra.*')">
                    Mitra Perusahaan
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.lowongan.index') }}" :active="request()->routeIs('admin.lowongan.*')">
                    Lowongan
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.artikel.index') }}" :active="request()->routeIs('admin.artikel.*')">
                    Artikel
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.galeri.index') }}" :active="request()->routeIs('admin.galeri.*')">
                    Galeri
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.alumni.index') }}" :active="request()->routeIs('admin.alumni.*')">
                    Alumni
                </x-admin.nav-link>

                <p class="px-4 pt-4 pb-1 text-[11px] uppercase tracking-[0.2em] text-slate-400">Lainnya</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-slate-200 hover:bg-white/10 hover:text-white transition-all duration-200">
                        Logout
                    </button>
                </form>
            </nav>
        </aside>

        {{-- Main --}}
        <div class="flex-1 lg:ml-64 min-w-0">
            <header class="h-16 bg-white/80 backdrop-blur-xl border-b border-white/70 shadow-sm flex items-center justify-between px-6 sticky top-0 z-20">
                <button class="lg:hidden text-slate-500" @click="sidebarOpen = !sidebarOpen">
                    &#9776;
                </button>
                <div class="hidden md:block">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Dashboard</p>
                    <p class="text-sm font-semibold text-slate-800">{{ $title ?? 'Dashboard Admin' }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.website') }}" target="_blank" rel="noopener noreferrer" class="hidden sm:inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:border-blue-200 hover:text-blue-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5M12 12L21 3m0 0h-6m6 0v6"/>
                        </svg>
                        Website
                    </a>
                    <span class="hidden sm:inline-flex text-sm text-slate-500">{{ now()->translatedFormat('d F Y') }}</span>
                    <div class="w-9 h-9 rounded-2xl bg-gradient-to-br from-blue-100 to-cyan-100 flex items-center justify-center text-blue-700 text-sm font-semibold shadow-sm">
                        {{ substr(auth('admin')->user()->name, 0, 1) }}
                    </div>
                    <div class="hidden sm:block leading-tight">
                        <p class="text-sm font-semibold text-slate-800">{{ auth('admin')->user()->name }}</p>
                        <p class="text-xs text-slate-400">Administrator</p>
                    </div>
                </div>
            </header>

            <main class="p-4 sm:p-6 lg:p-8">
                @if (session('status'))
                    <div class="mb-5 px-4 py-3 rounded-2xl bg-emerald-50 text-emerald-700 text-sm border border-emerald-100 shadow-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="max-w-[1600px] mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
