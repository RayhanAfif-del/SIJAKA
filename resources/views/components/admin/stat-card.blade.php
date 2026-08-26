@props(['label', 'value', 'change' => null, 'color' => 'blue', 'icon' => null])

@php
    $colors = [
        'blue'    => ['bg' => 'bg-blue-50',    'text' => 'text-blue-600',    'border' => 'border-blue-500'],
        'emerald' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-500'],
        'violet'  => ['bg' => 'bg-violet-50',  'text' => 'text-violet-600',  'border' => 'border-violet-500'],
        'amber'   => ['bg' => 'bg-amber-50',   'text' => 'text-amber-600',   'border' => 'border-amber-500'],
        // Alias untuk backward compatibility
        'green'   => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-500'],
        'purple'  => ['bg' => 'bg-violet-50',  'text' => 'text-violet-600',  'border' => 'border-violet-500'],
    ];
    $defaultIcons = [
        'blue'    => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
        'emerald' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
        'violet'  => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z',
        'amber'   => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222',
    ];
    $c = $colors[$color] ?? $colors['blue'];
    $iconPath = $icon ?? $defaultIcons[$color] ?? $defaultIcons['blue'];
    $formattedValue = is_numeric($value) ? number_format($value) : $value;
@endphp

<div class="group relative bg-white border border-slate-200/70 rounded-xl p-5 hover:shadow-md hover:border-slate-300 transition-all duration-200 overflow-hidden">
    {{-- Accent border kiri --}}
    <div class="absolute left-0 top-0 bottom-0 w-1 {{ $c['border'] }}"></div>
    
    <div class="flex items-start justify-between gap-3">
        <div class="min-w-0 flex-1">
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">{{ $label }}</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900 tracking-tight leading-none">{{ $formattedValue }}</p>
            
            @if ($change)
                @php
                    $isPositive = str_starts_with($change, '+') || str_contains($change, 'naik') || str_contains($change, 'increase');
                    $isNegative = str_starts_with($change, '-') || str_contains($change, 'turun') || str_contains($change, 'decrease');
                    $changeColor = $isPositive ? 'text-emerald-600' : ($isNegative ? 'text-red-600' : 'text-slate-500');
                    $changeIcon = $isPositive ? 'M5 10l7-7m0 0l7 7m-7-7v18' : ($isNegative ? 'M19 14l-7 7m0 0l-7-7m7 7V3' : null);
                @endphp
                <div class="flex items-center gap-1 mt-2">
                    @if ($changeIcon)
                        <svg class="w-3 h-3 {{ $changeColor }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $changeIcon }}"/>
                        </svg>
                    @endif
                    <span class="text-xs font-medium {{ $changeColor }}">{{ $change }}</span>
                </div>
            @endif
        </div>
        
        <div class="w-10 h-10 rounded-lg {{ $c['bg'] }} {{ $c['text'] }} flex items-center justify-center shrink-0 transition-transform duration-200 group-hover:scale-110">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $iconPath }}"/>
            </svg>
        </div>
    </div>
</div>