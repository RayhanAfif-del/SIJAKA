<x-layouts.admin title="Struktur Organisasi">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-700 transition">Dashboard</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-slate-700 font-medium">Struktur Organisasi</span>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Struktur Organisasi</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola data pengurus BKK yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('admin.struktur-organisasi.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Tambah Pengurus
        </a>
    </div>

    {{-- Grid Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @forelse ($struktur as $item)
            <div class="group bg-white border border-slate-200/70 rounded-xl p-5 shadow-sm hover:shadow-md hover:border-blue-200 transition-all duration-200 flex flex-col items-center text-center">
                
                {{-- Avatar --}}
                <div class="relative mb-4">
                    <div class="w-20 h-20 rounded-full ring-4 ring-slate-50 overflow-hidden bg-blue-50 flex items-center justify-center text-blue-600 text-xl font-bold shadow-sm">
                        @if ($item->foto)
                            <img src="{{ Storage::url($item->foto) }}" class="w-full h-full object-cover" alt="{{ $item->nama }}">
                        @else
                            {{ collect(explode(' ', $item->nama))->map(fn ($w) => strtoupper($w[0] ?? ''))->take(2)->implode('') }}
                        @endif
                    </div>
                    {{-- Status indicator (opsional, memberi kesan "aktif") --}}
                    <div class="absolute bottom-0 right-0 w-5 h-5 bg-emerald-500 border-2 border-white rounded-full" title="Data Aktif"></div>
                </div>

                {{-- Info --}}
                <h3 class="text-base font-semibold text-slate-900 mb-1 line-clamp-1 w-full" title="{{ $item->nama }}">
                    {{ $item->nama }}
                </h3>
                <p class="text-sm font-medium text-blue-600 mb-3">{{ $item->jabatan }}</p>
                
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-slate-100 text-xs font-medium text-slate-600 mb-5">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                    </svg>
                    Urutan: {{ $item->urutan }}
                </div>

                {{-- Actions --}}
                <div class="w-full flex items-center gap-2 pt-4 border-t border-slate-100 mt-auto">
                    <a href="{{ route('admin.struktur-organisasi.edit', $item) }}" class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:border-slate-300 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <form method="POST" action="{{ route('admin.struktur-organisasi.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengurus ini?')" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-medium text-red-600 bg-white border border-red-200 rounded-lg hover:bg-red-50 hover:border-red-300 transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            {{-- Empty State --}}
            <div class="col-span-full flex flex-col items-center justify-center py-16 bg-white border border-dashed border-slate-200 rounded-xl">
                <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-900 mb-1">Belum ada data struktur organisasi</h3>
                <p class="text-sm text-slate-500 mb-5 max-w-sm text-center">Mulai tambahkan pengurus BKK agar informasi dapat dilihat oleh publik di halaman depan.</p>
                <a href="{{ route('admin.struktur-organisasi.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Tambah Pengurus Pertama
                </a>
            </div>
        @endforelse
    </div>

</x-layouts.admin>