@props(['active' => false, 'href' => '#'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 ' . ($active ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-300 hover:bg-white/10 hover:text-white')]) }}>
    {{ $slot }}
</a>