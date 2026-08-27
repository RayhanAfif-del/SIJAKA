<x-layouts.admin title="Galeri">

    @php
        $kategoriColors = [
            'workshop'           => ['bg' => 'bg-blue-50',    'text' => 'text-blue-700',    'border' => 'border-blue-200',    'dot' => 'bg-blue-500'],
            'seminar'            => ['bg' => 'bg-violet-50',  'text' => 'text-violet-700',  'border' => 'border-violet-200',  'dot' => 'bg-violet-500'],
            'kunjungan industri' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'dot' => 'bg-emerald-500'],
            'job fair'           => ['bg' => 'bg-amber-50',   'text' => 'text-amber-700',   'border' => 'border-amber-200',   'dot' => 'bg-amber-500'],
            'training'           => ['bg' => 'bg-rose-50',    'text' => 'text-rose-700',    'border' => 'border-rose-200',    'dot' => 'bg-rose-500'],
            'sosialisasi'        => ['bg' => 'bg-cyan-50',    'text' => 'text-cyan-700',    'border' => 'border-cyan-200',    'dot' => 'bg-cyan-500'],
            'kegiatan lain'      => ['bg' => 'bg-slate-100',  'text' => 'text-slate-700',   'border' => 'border-slate-200',   'dot' => 'bg-slate-500'],
        ];
        $kategoriFilters = [
            'Semua'              => null,
            'Workshop'           => 'workshop',
            'Seminar'            => 'seminar',
            'Kunjungan Industri' => 'kunjungan industri',
            'Job Fair'           => 'job fair',
            'Training'           => 'training',
            'Sosialisasi'        => 'sosialisasi',
            'Kegiatan Lain'      => 'kegiatan lain',
        ];
    @endphp

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-700 transition">Dashboard</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-slate-700 font-medium">Galeri Kegiatan</span>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Galeri Kegiatan</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola dokumentasi foto kegiatan BKK yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Tambah Foto
        </a>
    </div>

    {{-- Search & Filter Bar --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm p-4 mb-5">
        <form method="GET" action="{{ route('admin.galeri.index') }}" class="grid gap-3 lg:grid-cols-[1fr_240px_auto] items-end">
            <div>
                <label for="cari" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Cari Foto</label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input id="cari" type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari judul kegiatan..." class="w-full pl-9 pr-4 py-2.5 rounded-lg border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition outline-none">
                </div>
            </div>

            <div>
                <label for="kategori" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Kategori</label>
                <div class="relative">
                    <select id="kategori" name="kategori" class="w-full pl-3 pr-8 py-2.5 rounded-lg border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition outline-none appearance-none bg-white cursor-pointer">
                        <option value="">Semua Kategori</option>
                        @foreach (array_slice($kategoriFilters, 1, null, true) as $label => $value)
                            <option value="{{ $value }}" @selected(request('kategori') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 lg:flex-none inline-flex items-center justify-center gap-1.5 rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </button>
                @if (request()->filled('cari') || request()->filled('kategori'))
                    <a href="{{ route('admin.galeri.index') }}" class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-slate-200 px-3 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:border-slate-300" title="Reset Filter">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </a>
                @endif
            </div>
        </form>

        {{-- Active Filters Info --}}
        @if (request()->filled('cari') || request()->filled('kategori'))
            <div class="mt-3 pt-3 border-t border-slate-100 flex flex-wrap items-center gap-2 text-xs">
                <span class="font-semibold text-slate-700">Filter aktif:</span>
                @if (request()->filled('cari'))
                    <span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-3 py-1 text-blue-700 border border-blue-100">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        "{{ request('cari') }}"
                    </span>
                @endif
                @if (request()->filled('kategori'))
                    <span class="inline-flex items-center gap-1 rounded-full bg-violet-50 px-3 py-1 text-violet-700 border border-violet-100">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        {{ ucfirst(request('kategori')) }}
                    </span>
                @endif
                <span class="ml-auto text-slate-500 font-medium">{{ $galeri->total() }} foto ditemukan</span>
            </div>
        @else
            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-500">Menampilkan <span class="font-semibold text-slate-700">{{ $galeri->total() }}</span> foto kegiatan</span>
            </div>
        @endif
    </div>

    {{-- Grid Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @forelse ($galeri as $item)
            @php
                $kategoriKey = strtolower($item->kategori ?? '');
                $kc = $kategoriColors[$kategoriKey] ?? $kategoriColors['kegiatan lain'];
            @endphp
            <div class="group bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden hover:shadow-lg hover:border-slate-300 transition-all duration-200">
                
                {{-- Thumbnail --}}
                <div class="relative aspect-[4/3] bg-gradient-to-br from-slate-100 to-slate-200 overflow-hidden">
                    @if ($item->foto)
                        <img src="{{ Storage::url($item->foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $item->judul }}">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    
                    {{-- Hover Overlay dengan Judul & Preview --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                        <p class="text-white text-sm font-semibold line-clamp-2 mb-2 drop-shadow">{{ $item->judul }}</p>
                        @if ($item->foto)
                            <button type="button" 
                                    @click="$dispatch('open-preview', { url: '{{ Storage::url($item->foto) }}', title: '{{ addslashes($item->judul) }}' })"
                                    class="inline-flex items-center gap-1 text-xs text-white/90 hover:text-white bg-white/10 hover:bg-white/20 backdrop-blur-sm px-2.5 py-1.5 rounded-lg transition w-fit">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Preview
                            </button>
                        @endif
                    </div>
                    
                    {{-- Kategori Badge (top-left) --}}
                    <div class="absolute top-3 left-3">
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $kc['bg'] }} {{ $kc['text'] }} border {{ $kc['border'] }} backdrop-blur-sm bg-opacity-90">
                            <span class="w-1.5 h-1.5 rounded-full {{ $kc['dot'] }}"></span>
                            {{ ucfirst($item->kategori) }}
                        </span>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-4">
                    <h3 class="text-sm font-semibold text-slate-900 line-clamp-2 mb-2 min-h-[2.5rem]" title="{{ $item->judul }}">
                        {{ $item->judul }}
                    </h3>
                    
                    <div class="flex items-center gap-1.5 text-xs text-slate-500 mb-3">
                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $item->tanggal->translatedFormat('d M Y') }}</span>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-1.5 pt-3 border-t border-slate-100">
                        <a href="{{ route('admin.galeri.edit', $item) }}" 
                           class="flex-1 inline-flex items-center justify-center gap-1 px-2.5 py-1.5 text-xs font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition"
                           title="Edit foto">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            <span class="hidden sm:inline">Edit</span>
                        </a>

                        <form method="POST" action="{{ route('admin.galeri.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini? Tindakan ini tidak dapat dibatalkan.')" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full inline-flex items-center justify-center gap-1 px-2.5 py-1.5 text-xs font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition"
                                    title="Hapus foto">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                <span class="hidden sm:inline">Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            {{-- Empty State --}}
            <div class="col-span-full flex flex-col items-center justify-center py-16 bg-white border border-dashed border-slate-200 rounded-xl">
                <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-900 mb-1">
                    @if (request()->filled('cari') || request()->filled('kategori'))
                        Tidak Ada Hasil
                    @else
                        Belum Ada Foto Galeri
                    @endif
                </h3>
                <p class="text-sm text-slate-500 mb-5 max-w-sm text-center">
                    @if (request()->filled('cari') || request()->filled('kategori'))
                        Tidak ditemukan foto yang cocok dengan filter Anda. Coba ubah kata kunci atau reset filter.
                    @else
                        Mulai unggah foto kegiatan pertama Anda untuk mendokumentasikan aktivitas BKK.
                    @endif
                </p>
                @if (request()->filled('cari') || request()->filled('kategori'))
                    <a href="{{ route('admin.galeri.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Reset Filter
                    </a>
                @else
                    <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                        Tambah Foto Pertama
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($galeri->hasPages())
        <div class="mt-6">
            {{ $galeri->links() }}
        </div>
    @endif

    {{-- Lightbox Preview Modal (Alpine.js) --}}
    <div x-data="{ 
            isOpen: false, 
            url: '', 
            title: '' 
        }" 
        @open-preview.window="isOpen = true; url = $event.detail.url; title = $event.detail.title"
        @keydown.escape.window="isOpen = false"
        x-show="isOpen" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/80 backdrop-blur-sm"
        @click.self="isOpen = false">
        
        <div class="relative max-w-4xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden" @click.stop>
            {{-- Header Modal --}}
            <div class="flex items-center justify-between p-4 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-sm font-semibold text-slate-900 truncate pr-4" x-text="title"></h3>
                <button type="button" @click="isOpen = false" class="p-1.5 rounded-lg hover:bg-slate-200 text-slate-500 hover:text-slate-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            {{-- Image --}}
            <div class="bg-slate-900 flex items-center justify-center p-4">
                <img :src="url" :alt="title" class="max-w-full max-h-[70vh] object-contain rounded-lg">
            </div>
        </div>
    </div>

</x-layouts.admin>