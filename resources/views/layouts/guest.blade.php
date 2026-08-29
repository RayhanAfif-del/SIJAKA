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
    <body class="font-sans antialiased text-slate-900 bg-slate-50">
        
        <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-12 sm:px-6 lg:px-8 relative">
            
            {{-- Subtle Background Gradient (Memberi kedalaman tanpa mengganggu) --}}
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(59,130,246,0.08),_transparent_40%)] pointer-events-none"></div>

            <div class="relative z-10 w-full max-w-md">
                
                {{-- Logo Area --}}
                <div class="flex justify-center mb-8">
                    <a href="{{ route('home') }}" class="flex flex-col items-center group">
                        <x-application-logo class="h-16 w-auto max-w-[4rem] group-hover:scale-105 transition-transform duration-300" />
                        <span class="mt-4 text-xl font-bold text-slate-900 tracking-tight group-hover:text-blue-600 transition">SIJAKA</span>
                        <span class="text-xs text-slate-500 font-medium">Sistem Informasi Jejaring Karier</span>
                    </a>
                </div>

                {{-- Card Container --}}
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 p-6 sm:p-8 backdrop-blur-sm">
                    {{ $slot }}
                </div>

                {{-- Back to Home Link --}}
                <div class="mt-6 text-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 hover:text-blue-600 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke beranda
                    </a>
                </div>
            </div>
        </div>

    </body>
</html>
