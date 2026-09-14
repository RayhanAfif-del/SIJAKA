<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex min-h-11 items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition duration-150 hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 disabled:opacity-25']) }}>
    {{ $slot }}
</button>
