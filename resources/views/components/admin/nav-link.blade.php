@props(['href', 'active' => false, 'icon' => null])

<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition ' .
        ($active
            ? 'bg-blue-600 text-white font-medium'
            : 'text-blue-100/80 hover:bg-blue-800/60 hover:text-white')]) }}>
    @if ($icon)
        <span class="w-5 text-center">{!! $icon !!}</span>
    @endif
    <span>{{ $slot }}</span>
</a>
