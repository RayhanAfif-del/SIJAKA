<!-- resources/views/components/document-button.blade.php -->
@props([
    'alumni',
    'type', // 'cv' or 'portfolio'
    'routeView',
    'routeDownload'
])
<div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 rounded-xl border border-slate-200 hover:border-indigo-500/50 hover:bg-indigo-50/30 transition-all duration-200 gap-3">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg @if($type === 'cv') bg-emerald-100 text-emerald-600 @else bg-indigo-100 text-indigo-600 @endif flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                @if($type === 'cv')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                @else
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                @endif
            </svg>
        </div>
        <div class="min-w-0 flex-1">
            <p class="text-sm font-medium text-slate-900 leading-tight">
                @if($type === 'cv')
                    Curriculum Vitae (CV)
                @else
                    File Portofolio
                @endif
            </p>
            <p class="text-xs text-slate-500 mt-0.5 truncate">
                @if($type === 'cv')
                    Berkas resume alumni
                @else
                    Karya dan dokumentasi proyek
                @endif
            </p>
        </div>
    </div>
    <div class="flex items-center gap-2 sm:self-center">
        <a href="{{ $routeView }}" target="_blank" class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-lg text-xs font-semibold bg-white text-slate-700 hover:bg-{{ $type === 'cv' ? 'emerald' : 'indigo' }}-50 hover:text-{{ $type === 'cv' ? 'emerald' : 'indigo' }}-700 border border-slate-200 hover:border-{{ $type === 'cv' ? 'emerald' : 'indigo' }}-300 transition-colors shadow-sm">
            <svg class="w-4 h-4 {{ $type === 'cv' ? 'text-emerald-600' : 'text-indigo-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            Lihat
        </a>
        <a href="{{ $routeDownload }}" class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-lg text-xs font-semibold bg-{{ $type === 'cv' ? 'emerald' : 'indigo' }}-600 text-white hover:bg-{{ $type === 'cv' ? 'emerald' : 'indigo' }}-700 transition-colors shadow-sm shadow-{{ $type === 'cv' ? 'emerald' : 'indigo' }}-600/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Unduh
        </a>
    </div>
</div>
