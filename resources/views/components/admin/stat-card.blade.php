@props(['label', 'value', 'change' => null, 'color' => 'blue'])

@php
    $colors = [
        'blue' => 'bg-blue-100 text-blue-600',
        'green' => 'bg-green-100 text-green-600',
        'purple' => 'bg-purple-100 text-purple-600',
        'amber' => 'bg-amber-100 text-amber-600',
    ];
@endphp

<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
    <div class="flex items-center gap-3 mb-3">
        <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ $colors[$color] ?? $colors['blue'] }}">
            {{ $icon ?? '' }}
        </div>
        <p class="text-sm text-gray-500">{{ $label }}</p>
    </div>
    <p class="text-2xl font-semibold text-gray-800">{{ $value }}</p>
    @if ($change)
        <p class="text-xs text-green-600 mt-1">{{ $change }}</p>
    @endif
</div>
