<x-layouts.public :title="$artikel->judul">

    <section class="max-w-3xl mx-auto px-4 py-10">
        <p class="text-sm text-gray-400 mb-4">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a> &gt;
            <a href="{{ route('artikel.index') }}" class="hover:text-blue-600">Artikel</a> &gt;
            {{ Str::limit($artikel->judul, 30) }}
        </p>

        <span class="inline-block bg-blue-50 text-blue-600 text-xs font-medium px-2.5 py-1 rounded mb-3">{{ $artikel->kategori }}</span>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3 leading-snug">{{ $artikel->judul }}</h1>
        <p class="text-xs text-gray-400 mb-6">
            Oleh {{ $artikel->admin->name ?? 'Admin SIJAKA' }} &middot; {{ $artikel->created_at->translatedFormat('d F Y') }}
        </p>

        @if ($artikel->gambar)
            <div class="rounded-xl overflow-hidden mb-8">
                <img src="{{ Storage::url($artikel->gambar) }}" class="w-full h-72 object-cover" alt="{{ $artikel->judul }}">
            </div>
        @endif

        <div class="prose prose-sm sm:prose-base max-w-none text-gray-600 leading-relaxed">
            {!! nl2br(e($artikel->konten)) !!}
        </div>

        <div class="mt-10 pt-6 border-t border-gray-100">
            <a href="{{ route('artikel.index') }}" class="inline-flex items-center gap-1 text-sm text-blue-600 hover:underline">&larr; Kembali ke Artikel</a>
        </div>
    </section>

</x-layouts.public>
