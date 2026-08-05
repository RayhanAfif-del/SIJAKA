<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard Mitra' }} - SIJAKA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-blue-700 text-white flex-shrink-0 fixed inset-y-0 left-0 z-30 transform transition-transform lg:translate-x-0"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="h-16 flex items-center gap-2 px-5 border-b border-blue-500/50">
                <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center text-blue-700 font-bold text-sm">SI</div>
                <div>
                    <p class="font-semibold leading-tight">SIJAKA</p>
                    <p class="text-[11px] text-blue-200 leading-tight">Sistem Informasi Jejaring Karier</p>
                </div>
            </div>

            <nav class="p-3 space-y-1">
                <x-admin.nav-link href="{{ route('mitra.dashboard') }}" :active="request()->routeIs('mitra.dashboard')">
                    Dashboard
                </x-admin.nav-link>

                <p class="px-4 pt-4 pb-1 text-[11px] uppercase tracking-wide text-blue-200">Menu Utama</p>

                <x-admin.nav-link href="{{ route('mitra.profil.edit') }}" :active="request()->routeIs('mitra.profil.*')">
                    Profil Perusahaan
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('mitra.lowongan.index') }}" :active="request()->routeIs('mitra.lowongan.*')">
                    Lowongan Saya
                </x-admin.nav-link>

                <div class="pt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-blue-100/80 hover:bg-blue-800/60 hover:text-white transition">
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        {{-- Main --}}
        <div class="flex-1 lg:ml-64">
            <header class="h-16 bg-white border-b border-gray-100 flex items-center justify-between px-6 sticky top-0 z-20">
                <button class="lg:hidden text-gray-500" @click="sidebarOpen = !sidebarOpen">
                    &#9776;
                </button>
                <div></div>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 text-sm font-medium">
                        {{ substr(auth('mitra')->user()->nama_perusahaan, 0, 1) }}
                    </div>
                    <div class="hidden sm:block leading-tight">
                        <p class="text-sm font-medium text-gray-800">{{ auth('mitra')->user()->nama_perusahaan }}</p>
                        <p class="text-xs text-gray-400">Mitra Perusahaan</p>
                    </div>
                </div>
            </header>

            <main class="p-6">
                @if (session('status'))
                    <div class="mb-4 px-4 py-3 rounded-lg bg-green-50 text-green-700 text-sm border border-green-100">
                        {{ session('status') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
