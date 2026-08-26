<x-layouts.admin title="Artikel">

    @php
        $kategoriColors = [
            'tips'        => ['bg' => 'bg-blue-50',    'text' => 'text-blue-700',    'border' => 'border-blue-200'],
            'karir'       => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200'],
            'info'        => ['bg' => 'bg-amber-50',   'text' => 'text-amber-700',   'border' => 'border-amber-200'],
            'berita'      => ['bg' => 'bg-violet-50',  'text' => 'text-violet-700',  'border' => 'border-violet-200'],
            'lowongan'    => ['bg' => 'bg-rose-50',    'text' => 'text-rose-700',    'border' => 'border-rose-200'],
            'pengembangan' => ['bg' => 'bg-cyan-50',   'text' => 'text-cyan-700',    'border' => 'border-cyan-200'],
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
                <span class="text-slate-700 font-medium">Artikel</span>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Artikel</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola artikel dunia kerja yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('admin.artikel.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Tulis Artikel
        </a>
    </div>

    {{-- Table Container --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50/80 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            Judul
                        </th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th class="px-5 py-3.5 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($artikel as $item)
                        @php
                            $kategoriKey = strtolower($item->kategori ?? '');
                            $kc = $kategoriColors[$kategoriKey] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-700', 'border' => 'border-slate-200'];
                        @endphp
                        <tr class="hover:bg-slate-50/50 transition">
                            {{-- Judul + Thumbnail --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3.5 min-w-0">
                                    <div class="w-16 h-11 rounded-lg bg-gradient-to-br from-slate-100 to-slate-200 overflow-hidden flex items-center justify-center shrink-0 ring-1 ring-slate-200/50">
                                        @if ($item->gambar)
                                            <img src="{{ Storage::url($item->gambar) }}" class="w-full h-full object-cover" alt="{{ $item->judul }}">
                                        @else
                                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-semibold text-slate-900 line-clamp-1" title="{{ $item->judul }}">
                                            {{ $item->judul }}
                                        </p>
                                        <p class="text-xs text-slate-500 line-clamp-1 mt-0.5">
                                            ID: #{{ $item->id }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Kategori --}}
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $kc['bg'] }} {{ $kc['text'] }} border {{ $kc['border'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current opacity-60"></span>
                                    {{ $item->kategori ?: '-' }}
                                </span>
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-1.5 text-sm text-slate-600">
                                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $item->created_at->translatedFormat('d M Y') }}</span>
                                </div>
                                <p class="text-[11px] text-slate-400 mt-0.5 ml-5">
                                    {{ $item->created_at->diffForHumans() }}
                                </p>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-1.5">
                                    {{-- Edit --}}
                                    <a href="{{ route('admin.artikel.edit', $item) }}" 
                                       class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition"
                                       title="Edit artikel">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        <span class="hidden sm:inline">Edit</span>
                                    </a>

                                    {{-- Hapus --}}
                                    <form method="POST" action="{{ route('admin.artikel.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini? Tindakan ini tidak dapat dibatalkan.')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition"
                                                title="Hapus artikel">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            <span class="hidden sm:inline">Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        {{-- Empty State --}}
                        <tr>
                            <td colspan="4" class="px-5 py-16">
                                <div class="flex flex-col items-center justify-center text-center">
                                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-semibold text-slate-900 mb-1">Belum ada artikel</h3>
                                    <p class="text-sm text-slate-500 mb-5 max-w-sm">Mulai tulis artikel pertama Anda untuk berbagi informasi dunia kerja kepada pengunjung.</p>
                                    <a href="{{ route('admin.artikel.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Tulis Artikel Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if ($artikel->hasPages())
        <div class="mt-5">
            {{ $artikel->links() }}
        </div>
    @endif

</x-layouts.admin>