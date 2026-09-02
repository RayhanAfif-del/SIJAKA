<x-layouts.public :title="$artikel->judul">

    @php
        $pengaturanWebsite = $pengaturanWebsite ?? \App\Models\PengaturanWebsite::singleton();
        $heroImageUrl = $pengaturanWebsite->hero_image ? \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->hero_image) : null;
    @endphp

    <section class="relative bg-slate-900 text-white overflow-hidden">
        @if ($heroImageUrl)
            <div class="absolute inset-0">
                <img src="{{ $heroImageUrl }}" alt="Background" class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-slate-900/90 to-slate-900/90"></div>
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-slate-900 to-slate-900"></div>
        @endif

        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 32px 32px;"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20" data-aos="fade-up">
            <nav class="flex items-center gap-2 text-sm text-blue-200 mb-6 flex-wrap">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('artikel.index') }}" class="hover:text-white transition">Artikel</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium truncate max-w-[220px] sm:max-w-md">{{ $artikel->judul }}</span>
            </nav>

            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-blue-100 text-xs font-semibold uppercase tracking-wider mb-4">
                {{ $artikel->kategori ?: 'Artikel' }}
            </span>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                {{ $artikel->judul }}
            </h1>
            <p class="text-blue-100 text-lg leading-relaxed max-w-2xl">
                Dibuat oleh {{ $artikel->admin->name ?? 'Admin SIJAKA' }} pada {{ $artikel->created_at->translatedFormat('d F Y') }}.
            </p>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">
        @if ($artikel->gambar)
            <div class="rounded-2xl overflow-hidden shadow-xl border border-gray-100 mb-8" data-aos="fade-up">
                <img src="{{ Storage::url($artikel->gambar) }}" class="w-full h-72 sm:h-96 object-cover" alt="{{ $artikel->judul }}">
            </div>
        @endif

        <article class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sm:p-8 lg:p-10" data-aos="fade-up">
            <div class="prose prose-slate max-w-none text-gray-600 leading-relaxed">
                {!! nl2br(e($artikel->konten)) !!}
            </div>

            <div class="mt-10 pt-6 border-t border-gray-100">
                <a href="{{ route('artikel.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Artikel
                </a>
            </div>
        </article>
    </section>

</x-layouts.public>
