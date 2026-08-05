@props(['label', 'value', 'change' => null, 'color' => 'blue', 'icon' => null])

@php
    $colors = [
        'blue' => 'bg-blue-100 text-blue-600',
        'green' => 'bg-green-100 text-green-600',
        'purple' => 'bg-purple-100 text-purple-600',
        'amber' => 'bg-amber-100 text-amber-600',
    ];
    $defaultIcons = [
        'blue' => 'M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6',
        'green' => 'M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        'purple' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m12 16a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4',
        'amber' => 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 1a3 3 0 10-3-3 3 3 0 003 3z',
    ];
    $iconPath = $icon ?? $defaultIcons[$color] ?? $defaultIcons['blue'];
@endphp

<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
    <div class="flex items-center gap-3 mb-3">
        <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ $colors[$color] ?? $colors['blue'] }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $iconPath }}"/>
            </svg>
        </div>
        <p class="text-sm text-gray-500">{{ $label }}</p>
    </div>
    <p class="text-2xl font-semibold text-gray-800">{{ $value }}</p>
    @if ($change)
        <p class="text-xs text-green-600 mt-1">{{ $change }}</p>
    @endif
</div>
