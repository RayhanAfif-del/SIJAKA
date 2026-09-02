<x-layouts.public title="Galeri Kegiatan">

    @php
        $pengaturanWebsite = $pengaturanWebsite ?? \App\Models\PengaturanWebsite::singleton();
        $heroImageUrl = $pengaturanWebsite->hero_image ? \Illuminate\Support\Facades\Storage::url($pengaturanWebsite->hero_image) : null;
        $kategoriColors = [
            'workshop'           => ['bg' => 'bg-blue-50',    'text' => 'text-blue-700',    'border' => 'border-blue-200',    'dot' => 'bg-blue-500'],
            'seminar'            => ['bg' => 'bg-violet-50',  'text' => 'text-violet-700',  'border' => 'border-violet-200',  'dot' => 'bg-violet-500'],
            'kunjungan industri' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'dot' => 'bg-emerald-500'],
            'job fair'           => ['bg' => 'bg-amber-50',   'text' => 'text-amber-700',   'border' => 'border-amber-200',   'dot' => 'bg-amber-500'],
            'training'           => ['bg' => 'bg-rose-50',    'text' => 'text-rose-700',    'border' => 'border-rose-200',    'dot' => 'bg-rose-500'],
            'sosialisasi'        => ['bg' => 'bg-cyan-50',    'text' => 'text-cyan-700',    'border' => 'border-cyan-200',    'dot' => 'bg-cyan-500'],
            'kegiatan lain'      => ['bg' => 'bg-slate-100',  'text' => 'text-slate-700',   'border' => 'border-slate-200',   'dot' => 'bg-slate-500'],
        ];
    @endphp

    {{-- Hero Section --}}
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
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-blue-200 mb-6 flex-wrap">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium">Galeri Kegiatan</span>
            </nav>
            
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mb-4">
                Galeri <span class="text-blue-400">Kegiatan</span>
            </h1>
            <p class="text-blue-100 text-lg leading-relaxed max-w-2xl">
                Dokumentasi berbagai kegiatan yang telah dilaksanakan oleh SIJAKA SMK N 1 Bangsri bersama sekolah, siswa, alumni, dan mitra.
            </p>
        </div>
    </section>

    {{-- Filter Kategori --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 mb-10" data-aos="fade-up">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-5">
            <div class="flex items-center gap-2 mb-3">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Filter Kategori</span>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('galeri.index') }}" 
                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ !request('kategori') ? 'bg-blue-600 text-white shadow-md shadow-slate-900/20' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    Semua Kegiatan
                </a>
                @foreach ($kategoriList as $kategori)
                    @php
                        $kategoriKey = strtolower($kategori);
                        $kc = $kategoriColors[$kategoriKey] ?? $kategoriColors['kegiatan lain'];
                    @endphp
                    <a href="{{ route('galeri.index', ['kategori' => $kategori]) }}" 
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ request('kategori') === $kategori ? 'bg-blue-600 text-white shadow-md shadow-slate-900/20' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $kc['dot'] }}"></span>
                        {{ $kategori }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Gallery Grid --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @forelse ($galeri as $index => $item)
                @php
                    $kategoriKey = strtolower($item['kategori'] ?? '');
                    $kc = $kategoriColors[$kategoriKey] ?? $kategoriColors['kegiatan lain'];
                    $cover = $item['cover'];
                    $photos = $item['items'];
                    $previewItems = $photos->map(function ($photo) {
                        return [
                            'url' => Storage::url($photo->foto),
                            'title' => $photo->judul,
                            'date' => $photo->tanggal?->translatedFormat('d F Y'),
                            'kategori' => $photo->kategori,
                        ];
                    })->values();
                    $stackThumbs = $previewItems->take(3);
                    $isFirst = $index === 0;
                @endphp
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-xl hover:border-blue-100 hover:-translate-y-1 transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 50 }}">
                    
                    {{-- Thumbnail --}}
                    <div class="relative aspect-[4/3] bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden cursor-pointer"
                         @if ($cover?->foto)
                         @click="$dispatch('open-stack-preview', { title: @js($item['judul']), date: @js(optional($item['tanggal'])->translatedFormat('d F Y')), kategori: @js($item['kategori']), items: @js($previewItems), startIndex: 0 })"
                         @endif>
                        @if ($cover?->foto)
                            <img src="{{ Storage::url($cover->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $item['judul'] }}">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        
                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                            <p class="text-white text-sm font-semibold line-clamp-2 mb-2 drop-shadow">{{ $item['judul'] }}</p>
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-white/80 text-xs flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ optional($item['tanggal'])->translatedFormat('d M Y') }}
                                </span>
                                <span class="inline-flex items-center gap-1 text-xs text-white bg-white/20 backdrop-blur-sm px-2 py-1 rounded-md">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                    {{ $item['count'] }} foto
                                </span>
                            </div>
                        </div>
                        
                        {{-- Stack / Kategori Badge --}}
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $kc['bg'] }} {{ $kc['text'] }} border {{ $kc['border'] }} backdrop-blur-sm bg-opacity-90">
                                <span class="w-1.5 h-1.5 rounded-full {{ $kc['dot'] }}"></span>
                                {{ ucfirst($item['kategori']) }}
                            </span>
                        </div>

                        @if ($stackThumbs->count() > 1)
                            <div class="absolute bottom-3 right-3 flex items-end -space-x-3">
                                @foreach ($stackThumbs as $thumb)
                                    <div class="w-11 h-11 rounded-xl border-2 border-white shadow-lg overflow-hidden bg-white/30 backdrop-blur-sm {{ $loop->index === 0 ? 'translate-y-0' : 'translate-y-1' }}">
                                        <img src="{{ $thumb['url'] }}" alt="{{ $thumb['title'] }}" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900 line-clamp-2 mb-2 min-h-[2.5rem]" title="{{ $item['judul'] }}">
                            {{ $item['judul'] }}
                        </h3>
                        <div class="flex items-center gap-1.5 text-xs text-gray-500">
                            <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ optional($item['tanggal'])->translatedFormat('d M Y') }}</span>
                        </div>
                        <div class="mt-3 inline-flex items-center gap-1 text-xs font-medium text-slate-600 bg-slate-50 px-2.5 py-1.5 rounded-lg">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/>
                            </svg>
                            Klik untuk membuka {{ $item['count'] }} foto
                        </div>
                    </div>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="col-span-full py-16 text-center" data-aos="fade-up">
                    <div class="max-w-md mx-auto">
                        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-5">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            @if (request('kategori'))
                                Tidak Ada Foto untuk Kategori "{{ request('kategori') }}"
                            @else
                                Belum Ada Dokumentasi Kegiatan
                            @endif
                        </h3>
                        <p class="text-gray-500 leading-relaxed mb-6">
                            @if (request('kategori'))
                                Belum ada foto yang terdaftar untuk kategori ini. Silakan pilih kategori lain atau lihat semua kegiatan.
                            @else
                                Dokumentasi kegiatan BKK akan segera tersedia. Silakan kunjungi kami kembali nanti.
                            @endif
                        </p>
                        <a href="{{ route('galeri.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-xl transition shadow-lg shadow-slate-900/10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            Lihat Semua Kegiatan
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($galeri->hasPages())
            <div class="mt-12 flex justify-center" data-aos="fade-up">
                {{ $galeri->links() }}
            </div>
        @endif
    </section>

    {{-- Stack Preview Modal --}}
    <div
        x-data="{
            isOpen: false,
            title: '',
            date: '',
            kategori: '',
            items: [],
            selectedIndex: 0,
            currentItem() {
                return this.items[this.selectedIndex] || {};
            },
            open(detail) {
                this.isOpen = true;
                this.title = detail.title || '';
                this.date = detail.date || '';
                this.kategori = detail.kategori || '';
                this.items = detail.items || [];
                this.selectedIndex = detail.startIndex || 0;
            }
        }"
        @open-stack-preview.window="open($event.detail)"
        @keydown.escape.window="isOpen = false"
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/90 backdrop-blur-sm"
        @click.self="isOpen = false">

        <div class="relative max-w-6xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden" @click.stop>
            {{-- Header Modal --}}
            <div class="flex items-start justify-between gap-4 p-4 border-b border-slate-100 bg-slate-50/50">
                <div class="min-w-0 flex-1">
                    <h3 class="text-sm font-bold text-slate-900 truncate" x-text="title"></h3>
                    <div class="flex flex-wrap items-center gap-3 mt-1 text-xs text-slate-500">
                        <span class="flex items-center gap-1" x-show="date">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span x-text="date"></span>
                        </span>
                        <span class="flex items-center gap-1" x-show="kategori">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <span x-text="kategori"></span>
                        </span>
                        <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2 py-0.5 text-slate-600 font-medium" x-show="items.length">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/>
                            </svg>
                            <span x-text="items.length + ' foto'"></span>
                        </span>
                    </div>
                </div>
                <button type="button" @click="isOpen = false" class="p-2 rounded-lg hover:bg-slate-200 text-slate-500 hover:text-slate-700 transition shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="grid lg:grid-cols-[1fr_320px] bg-slate-950">
                <div class="flex items-center justify-center p-4 md:p-6 min-h-[420px]">
                    <template x-if="items.length">
                        <img :src="currentItem().url" :alt="currentItem().title || title" class="max-w-full max-h-[72vh] object-contain rounded-xl shadow-2xl bg-white/5">
                    </template>
                </div>

                <div class="border-t lg:border-t-0 lg:border-l border-white/10 bg-slate-900 p-4 md:p-5">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Foto Lain</p>
                            <p class="text-xs text-slate-500 mt-1">Klik thumbnail untuk berpindah</p>
                        </div>
                        <span class="text-xs text-slate-300" x-show="items.length" x-text="(selectedIndex + 1) + ' / ' + items.length"></span>
                    </div>

                    <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-2 gap-2 max-h-[72vh] overflow-y-auto pr-1">
                        <template x-for="(photo, index) in items" :key="photo.url + '-' + index">
                            <button
                                type="button"
                                class="relative aspect-square rounded-xl overflow-hidden border-2 transition focus:outline-none"
                                :class="selectedIndex === index ? 'border-amber-400 ring-2 ring-amber-400/30' : 'border-white/10 hover:border-white/40'"
                                @click="selectedIndex = index">
                                <img :src="photo.url" :alt="photo.title || title" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/0 hover:bg-black/15 transition"></div>
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.public>
