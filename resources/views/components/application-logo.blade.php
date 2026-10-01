@php
    $pengaturanLayout = null;
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('pengaturan_website')) {
            $pengaturanLayout = \App\Models\PengaturanWebsite::singleton();
        }
    } catch (\Throwable $e) {}

    $logoUrl = null;
    if ($pengaturanLayout && !empty($pengaturanLayout->site_icon)) {
        $logoUrl = \Illuminate\Support\Facades\Storage::url($pengaturanLayout->site_icon);
    }

    if (!$logoUrl) {
        $logoFiles = [
            'logo.png',
            'logo.svg',
            'logo.webp',
            'logo.jpg',
            'logo.jpeg',
        ];

        foreach ($logoFiles as $file) {
            if (file_exists(public_path($file))) {
                $logoUrl = asset($file);
                break;
            }
        }

        // Fallback jika file_exists gagal karena perbedaan path webroot hosting/cPanel
        if (!$logoUrl) {
            $logoUrl = asset('logo.png');
        }
    }
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
