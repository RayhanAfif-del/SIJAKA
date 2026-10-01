<!-- resources/views/components/document-button.blade.php -->
@props([
    'alumni',
    'type', // 'cv' or 'portfolio'
    'routeView',
    'routeDownload',
    'compact' => false,
])

@php
    $isCv = $type === 'cv';
    $title = $isCv ? 'Curriculum Vitae (CV)' : 'File Portofolio';
    $subtitle = $isCv ? 'Berkas resume alumni' : 'Karya dan dokumentasi proyek';
    
    // Explicit Tailwind classes to ensure reliable CSS compilation
    $iconBg = $isCv 
        ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' 
        : 'bg-indigo-50 text-indigo-600 border border-indigo-100';
    $viewBtnClass = $isCv 
        ? 'hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-200' 
        : 'hover:bg-indigo-50 hover:text-indigo-700 hover:border-indigo-200';
    $downloadBtnClass = $isCv 
        ? 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-600/20' 
        : 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-indigo-600/20';
@endphp

@if($compact)
    {{-- Compact / Sidebar layout --}}
    <div class="p-3.5 rounded-xl border border-slate-200/80 bg-white hover:border-slate-300 transition-all duration-200 group">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl {{ $iconBg }} flex items-center justify-center shrink-0 transition-transform group-hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    @if($isCv)
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    @endif
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-semibold text-slate-900 leading-tight group-hover:text-blue-700 transition-colors">{{ $title }}</p>
                <p class="text-xs text-slate-500 mt-0.5 truncate">{{ $subtitle }}</p>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-2 mt-3 pt-3 border-t border-slate-100">
            <a href="{{ $routeView }}" target="_blank" class="inline-flex min-h-9 items-center justify-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-white text-slate-700 border border-slate-200 shadow-sm transition hover:bg-slate-50 hover:text-slate-900 active:scale-[0.98] {{ $viewBtnClass }}">
                <svg class="w-3.5 h-3.5 {{ $isCv ? 'text-emerald-600' : 'text-indigo-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <span>Lihat</span>
            </a>
            <a href="{{ $routeDownload }}" class="inline-flex min-h-9 items-center justify-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition active:scale-[0.98] {{ $downloadBtnClass }}">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                <span>Unduh</span>
            </a>
        </div>
    </div>
@else
    {{-- Full / Horizontal layout for wide containers --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 rounded-xl border border-slate-200/80 bg-white hover:border-slate-300 hover:bg-slate-50/40 transition-all duration-200 gap-3 group">
        <div class="flex items-center gap-3 min-w-0">
            <div class="w-10 h-10 rounded-xl {{ $iconBg }} flex items-center justify-center shrink-0 transition-transform group-hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    @if($isCv)
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    @endif
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-semibold text-slate-900 leading-tight">{{ $title }}</p>
                <p class="text-xs text-slate-500 mt-0.5 truncate">{{ $subtitle }}</p>
            </div>
        </div>
        <div class="flex items-center gap-2 shrink-0 sm:self-center">
            <a href="{{ $routeView }}" target="_blank" class="inline-flex min-h-9 items-center justify-center gap-1.5 px-3.5 py-2 rounded-lg text-xs font-semibold bg-white text-slate-700 border border-slate-200 shadow-sm transition-all duration-150 {{ $viewBtnClass }}">
                <svg class="w-4 h-4 {{ $isCv ? 'text-emerald-600' : 'text-indigo-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <span>Lihat</span>
            </a>
            <a href="{{ $routeDownload }}" class="inline-flex min-h-9 items-center justify-center gap-1.5 px-3.5 py-2 rounded-lg text-xs font-semibold shadow-sm transition-all duration-150 {{ $downloadBtnClass }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                <span>Unduh</span>
            </a>
        </div>
    </div>
@endif

