<x-layouts.mitra title="Kelola Lowongan">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                <a href="{{ route('mitra.dashboard') }}" class="hover:text-slate-700 transition">Dashboard</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-slate-700 font-medium">Lowongan Saya</span>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Lowongan Saya</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola dan pantau status lowongan pekerjaan yang Anda ajukan.</p>
        </div>
        <a href="{{ route('mitra.lowongan.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Tambah Lowongan
        </a>
    </div>

    @php
        $statusConfig = [
            'menunggu'  => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-200', 'dot' => 'bg-amber-500'],
            'disetujui' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'dot' => 'bg-emerald-500'],
            'ditolak'   => ['bg' => 'bg-red-50', 'text' => 'text-red-700', 'border' => 'border-red-200', 'dot' => 'bg-red-500'],
        ];
    @endphp

    {{-- Table Container --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50/80 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            Posisi
                        </th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            Lokasi
                        </th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            Deadline
                        </th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-5 py-3.5 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($lowongan as $item)
                        @php $sc = $statusConfig[$item->status] ?? $statusConfig['menunggu']; @endphp
                        <tr class="hover:bg-slate-50/50 transition">
                            {{-- Posisi --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center text-blue-600 shrink-0 ring-1 ring-blue-200/50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-semibold text-slate-900 line-clamp-1" title="{{ $item->posisi }}">
                                            {{ $item->posisi }}
                                        </p>
                                        <p class="text-xs text-slate-500 line-clamp-1 mt-0.5">
                                            ID: #{{ $item->id }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Lokasi --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-1.5 text-sm text-slate-600">
                                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="line-clamp-1">{{ $item->lokasi ?: '-' }}</span>
                                </div>
                            </td>

                            {{-- Deadline --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-1.5 text-sm text-slate-600">
                                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $item->deadline->translatedFormat('d M Y') }}</span>
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $sc['bg'] }} {{ $sc['text'] }} border {{ $sc['border'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $sc['dot'] }}"></span>
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('mitra.lowongan.edit', $item) }}" 
                                       class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition"
                                       title="Edit lowongan">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        <span class="hidden sm:inline">Edit</span>
                                    </a>

                                    <form method="POST" action="{{ route('mitra.lowongan.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini? Tindakan ini tidak dapat dibatalkan.')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition"
                                                title="Hapus lowongan">
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
                            <td colspan="5" class="px-5 py-16">
                                <div class="flex flex-col items-center justify-center text-center">
                                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-semibold text-slate-900 mb-1">Belum ada lowongan</h3>
                                    <p class="text-sm text-slate-500 mb-5 max-w-sm">Mulai buat lowongan pekerjaan pertama Anda untuk menjangkau lebih banyak calon karyawan potensial.</p>
                                    <a href="{{ route('mitra.lowongan.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                        </svg>
                                        Buat Lowongan Pertama
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
    @if ($lowongan->hasPages())
        <div class="mt-5">
            {{ $lowongan->links() }}
        </div>
    @endif

</x-layouts.mitra>