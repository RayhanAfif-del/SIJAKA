<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard Mitra' }} - SIJAKA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
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
                <div class="w-9 h-9 rounded-xl flex items-center justify-center overflow-hidden shrink-0 bg-transparent">
                    <x-application-logo class="w-full h-full object-contain" />
                </div>
                <div class="min-w-0">
                    <p class="font-bold text-sm text-white leading-tight tracking-wide">SIJAKA</p>
                    <p class="text-[10px] text-slate-400 leading-tight truncate">Portal Mitra Perusahaan</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto custom-scrollbar p-3 space-y-1">
                <x-admin.nav-link href="{{ route('mitra.dashboard') }}" :active="request()->routeIs('mitra.dashboard')">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    Dashboard
                </x-admin.nav-link>

                <div class="pt-4 pb-1">
                    <p class="px-3 text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-500">Menu Utama</p>
                </div>

                <x-admin.nav-link href="{{ route('mitra.profil.edit') }}" :active="request()->routeIs('mitra.profil.*')">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Profil Perusahaan
                </x-admin.nav-link>

                <x-admin.nav-link href="{{ route('mitra.lowongan.index') }}" :active="request()->routeIs('mitra.lowongan.*')">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Lowongan Saya
                </x-admin.nav-link>

                <x-admin.nav-link href="{{ route('mitra.talent-pool.index') }}" :active="request()->routeIs('mitra.talent-pool.*')">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5m10 0v-4H7v4m10 0H7m2-8h6m-6-4h6"/>
                    </svg>
                    Direktori Talenta
                </x-admin.nav-link>

                <x-admin.nav-link href="{{ route('mitra.interview-requests.index') }}" :active="request()->routeIs('mitra.interview-requests.*')">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h8m-8 4h5m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Permintaan Wawancara
                </x-admin.nav-link>

                <div class="pt-4 pb-1 mt-auto">
                    <p class="px-3 text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-500">Lainnya</p>
                </div>

                {{-- Logout Button --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="group w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-red-500/10 hover:text-red-400 transition-all duration-200">
                        <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Keluar</span>
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
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div class="hidden sm:block">
                        <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-400">Dashboard</p>
                        <p class="text-sm font-semibold text-slate-800 leading-tight">{{ $title ?? 'Dashboard Mitra' }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="h-6 w-px bg-slate-200 hidden sm:block"></div>

                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-slate-800 leading-tight truncate max-w-[150px]" title="{{ auth('mitra')->user()->nama_perusahaan }}">
                                {{ auth('mitra')->user()->nama_perusahaan }}
                            </p>
                            <p class="text-[11px] text-slate-500">Mitra Perusahaan</p>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-white text-sm font-bold shadow-md shadow-blue-500/20 ring-2 ring-white shrink-0">
                            {{ strtoupper(substr(auth('mitra')->user()->nama_perusahaan, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if (session('status'))
                    <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 text-sm border border-emerald-100 shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 px-4 py-3 rounded-xl bg-red-50 text-red-700 text-sm border border-red-100 shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="max-w-[1440px] mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
