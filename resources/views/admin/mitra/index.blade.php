<x-layouts.admin title="Mitra Perusahaan">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-700 transition">Dashboard</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-slate-700 font-medium">Mitra Perusahaan</span>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Mitra Perusahaan</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola akun perusahaan mitra SIJAKA dan pantau aktivitas mereka.</p>
        </div>
        <a href="{{ route('admin.mitra.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Tambah Mitra
        </a>
    </div>

    {{-- Table Container --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50/80 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            Perusahaan
                        </th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            Total Lowongan
                        </th>
                        <th class="px-5 py-3.5 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($mitra as $item)
                        <tr class="hover:bg-slate-50/50 transition">
                            {{-- Perusahaan --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center text-blue-600 text-xs font-bold overflow-hidden shrink-0 ring-1 ring-blue-200/50">
                                        @if ($item->logo)
                                            <img src="{{ Storage::url($item->logo) }}" class="w-full h-full object-cover" alt="{{ $item->nama_perusahaan }}">
                                        @else
                                            {{ strtoupper(substr($item->nama_perusahaan, 0, 2)) }}
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-semibold text-slate-900 line-clamp-1" title="{{ $item->nama_perusahaan }}">
                                            {{ $item->nama_perusahaan }}
                                        </p>
                                        <p class="text-xs text-slate-500 line-clamp-1 mt-0.5">
                                            ID: {{ $item->id }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Email --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-1.5 text-sm text-slate-600">
                                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="line-clamp-1">{{ $item->email }}</span>
                                </div>
                            </td>

                            {{-- Total Lowongan --}}
                            <td class="px-5 py-4">
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-slate-100 text-xs font-semibold text-slate-700">
                                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    {{ number_format($item->lowongan_count) }}
                                </div>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-1.5">
                                    {{-- Edit --}}
                                    <a href="{{ route('admin.mitra.edit', $item) }}" 
                                       class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition"
                                       title="Edit data mitra">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        <span class="hidden sm:inline">Edit</span>
                                    </a>

                                    {{-- Reset Password --}}
                                    <form method="POST" action="{{ route('admin.mitra.reset-password', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin mereset password mitra ini? Password akan direset ke default.')" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-amber-600 bg-amber-50 border border-amber-200 rounded-lg hover:bg-amber-100 hover:border-amber-300 transition"
                                                title="Reset password ke default">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                            </svg>
                                            <span class="hidden sm:inline">Reset</span>
                                        </button>
                                    </form>

                                    {{-- Hapus --}}
                                    <form method="POST" action="{{ route('admin.mitra.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun mitra ini? Tindakan ini tidak dapat dibatalkan.')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition"
                                                title="Hapus akun mitra">
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
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-semibold text-slate-900 mb-1">Belum ada mitra terdaftar</h3>
                                    <p class="text-sm text-slate-500 mb-5 max-w-sm">Mulai tambahkan perusahaan mitra agar mereka dapat memposting lowongan kerja untuk alumni.</p>
                                    <a href="{{ route('admin.mitra.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                        </svg>
                                        Tambah Mitra Pertama
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
    @if ($mitra->hasPages())
        <div class="mt-5">
            {{ $mitra->links() }}
        </div>
    @endif

</x-layouts.admin>