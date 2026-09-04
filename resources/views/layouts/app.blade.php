<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'SIJAKA') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body class="bg-slate-50 font-sans antialiased text-slate-900 flex flex-col min-h-screen">
        
        {{-- Minimal Top Navigation (Untuk halaman auth seperti Profile/Password) --}}
        <nav class="bg-white border-b border-slate-200 sticky top-0 z-30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                            <x-application-logo class="h-8 w-auto max-w-[2rem] group-hover:scale-105 transition-transform duration-300" />
                            <span class="text-lg font-bold text-slate-900 tracking-tight group-hover:text-blue-600 transition">SIJAKA</span>
                        </a>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ route('home') }}" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition">
                                Kembali ke Beranda
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700 transition">
                                    Keluar
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        {{-- Page Heading --}}
        @isset($header)
            <header class="bg-white border-b border-slate-200">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Page Content --}}
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                
                {{-- Flash Messages --}}
                @if (session('status'))
                    <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 text-sm border border-emerald-100 shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('status') }}
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>

        {{-- Simple Footer --}}
        <footer class="bg-white border-t border-slate-200 mt-auto">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-sm text-slate-500">
                    &copy; {{ date('Y') }} {{ config('app.name', 'SIJAKA') }}. All rights reserved.
                </p>
            </div>
        </footer>

    </body>
</html>
