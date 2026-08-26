<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard Mitra' }} - SIJAKA</title>
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

            <nav class="p-3 space-y-1">
                <x-admin.nav-link href="{{ route('mitra.dashboard') }}" :active="request()->routeIs('mitra.dashboard')">
                    Dashboard
                </x-admin.nav-link>

                <p class="px-4 pt-4 pb-1 text-[11px] uppercase tracking-[0.2em] text-slate-400">Menu Utama</p>

                <x-admin.nav-link href="{{ route('mitra.profil.edit') }}" :active="request()->routeIs('mitra.profil.*')">
                    Profil Perusahaan
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('mitra.lowongan.index') }}" :active="request()->routeIs('mitra.lowongan.*')">
                    Lowongan Saya
                </x-admin.nav-link>

                <div class="pt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-slate-200 hover:bg-white/10 hover:text-white transition-all duration-200">
                            Logout
                        </button>
                    </form>
                </div>
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
                    <p class="text-sm font-semibold text-slate-800">{{ $title ?? 'Dashboard Mitra' }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-2xl bg-gradient-to-br from-blue-100 to-cyan-100 flex items-center justify-center text-blue-700 text-sm font-semibold shadow-sm">
                        {{ substr(auth('mitra')->user()->nama_perusahaan, 0, 1) }}
                    </div>
                    <div class="hidden sm:block leading-tight">
                        <p class="text-sm font-semibold text-slate-800">{{ auth('mitra')->user()->nama_perusahaan }}</p>
                        <p class="text-xs text-slate-400">Mitra Perusahaan</p>
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
