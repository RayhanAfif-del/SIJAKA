<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex min-h-11 items-center justify-center gap-2 rounded-lg border border-transparent bg-gray-800 px-4 py-2 text-sm font-semibold text-white transition duration-150 hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/20']) }}>
    {{ $slot }}
</button>
