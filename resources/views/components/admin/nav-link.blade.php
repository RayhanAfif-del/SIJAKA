@props(['href', 'active' => false, 'icon' => null])

<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-all duration-200 ' .
        ($active
            ? 'bg-white text-blue-950 font-semibold shadow-sm ring-1 ring-white/20'
            : 'text-blue-100/80 hover:bg-white/10 hover:text-white hover:translate-x-0.5')]) }}>
    @if ($icon)
        <span class="w-5 text-center opacity-90">{!! $icon !!}</span>
    @endif
    <span>{{ $slot }}</span>
</a>
