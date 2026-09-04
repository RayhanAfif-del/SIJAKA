@php
    $logoFiles = [
        public_path('logo.png'),
        public_path('logo.png'),
        public_path('logo.webp'),
        public_path('logo.jpg'),
        public_path('logo.jpeg'),
    ];

    $logoPath = collect($logoFiles)->first(fn ($path) => file_exists($path));
    $logoUrl = $logoPath ? asset(basename($logoPath)) : null;
@endphp

@if ($logoUrl)
    <img
        src="{{ $logoUrl }}"
        alt="{{ $attributes->get('alt', config('app.name', 'SIJAKA')) }}"
        {{ $attributes->merge(['class' => 'block bg-transparent object-contain']) }}
    >
@else
    <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
        <rect x="6" y="6" width="52" height="52" rx="14" fill="#2563eb"/>
        <path d="M20 22h24v6H20zm0 12h24v6H20z" fill="#fff"/>
    </svg>
@endif
