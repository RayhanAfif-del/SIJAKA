<x-layouts.admin title="Galeri">

    @php
        $kategoriColors = [
            'workshop'          => ['bg' => 'bg-blue-50',    'text' => 'text-blue-700',    'border' => 'border-blue-200'],
            'seminar'           => ['bg' => 'bg-violet-50',  'text' => 'text-violet-700',  'border' => 'border-violet-200'],
            'kunjungan industri' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200'],
            'job fair'          => ['bg' => 'bg-amber-50',   'text' => 'text-amber-700',   'border' => 'border-amber-200'],
            'training'          => ['bg' => 'bg-rose-50',    'text' => 'text-rose-700',    'border' => 'border-rose-200'],
            'sosialisasi'       => ['bg' => 'bg-cyan-50',    'text' => 'text-cyan-700',    'border' => 'border-cyan-200'],
            'kegiatan lain'     => ['bg' => 'bg-slate-100',  'text' => 'text-slate-700',   'border' => 'border-slate-200'],
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
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Tambah Galeri
        </a>
    </div>

    {{-- Grid Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @forelse ($galeri as $item)
            @php
                $kategoriKey = strtolower($item->kategori ?? '');
                $kc = $kategoriColors[$kategoriKey] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-700', 'border' => 'border-slate-200'];
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
                    
                    {{-- Hover Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    {{-- Kategori Badge (top-left) --}}
                    <div class="absolute top-3 left-3">
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $kc['bg'] }} {{ $kc['text'] }} border {{ $kc['border'] }} backdrop-blur-sm bg-opacity-90">
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
                <h3 class="text-base font-semibold text-slate-900 mb-1">Belum ada foto galeri</h3>
                <p class="text-sm text-slate-500 mb-5 max-w-sm text-center">Mulai unggah foto kegiatan pertama Anda untuk mendokumentasikan aktivitas BKK.</p>
                <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Tambah Foto Pertama
                </a>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($galeri->hasPages())
        <div class="mt-6">
            {{ $galeri->links() }}
        </div>
    @endif

</x-layouts.admin>