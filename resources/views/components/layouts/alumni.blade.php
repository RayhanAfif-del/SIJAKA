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
            </div>

            <nav class="flex-1 overflow-y-auto custom-scrollbar p-3 space-y-1">
                <div class="pt-4 pb-1"><p class="px-3 text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-500">Menu Alumni</p></div>
                <x-admin.nav-link href="{{ route('alumni.profile.edit') }}" :active="request()->routeIs('alumni.profile.*')">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profil Saya
                </x-admin.nav-link>

                <div class="pt-4 pb-1 mt-auto"><p class="px-3 text-[10px] font-semibold uppercase tracking-[0.2em] text-slate-500">Lainnya</p></div>
                <form method="POST" action="{{ route('alumni.logout') }}">
                    @csrf
                    <button type="submit" class="group w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-red-500/10 hover:text-red-400 transition-all duration-200">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </nav>
        </aside>

        <div class="flex-1 lg:ml-64 min-w-0 flex flex-col">
            <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200/80 flex items-center justify-between px-4 sm:px-6 sticky top-0 z-10">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 -ml-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition" aria-label="Buka menu navigasi">
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

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if (session('status'))
                    <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 text-sm border border-emerald-100 shadow-sm">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="max-w-[1440px] mx-auto">{{ $slot }}</div>
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>