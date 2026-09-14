<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex min-h-11 items-center justify-center gap-2 rounded-lg border border-transparent bg-red-600 px-4 py-2 text-sm font-semibold text-white transition duration-150 hover:bg-red-500 focus:outline-none focus:ring-4 focus:ring-red-500/20']) }}>
    {{ $slot }}
</button>
