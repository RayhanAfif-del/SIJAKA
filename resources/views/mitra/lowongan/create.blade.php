<x-layouts.mitra title="Tambah Lowongan">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                <a href="{{ route('mitra.dashboard') }}" class="hover:text-slate-700 transition">Dashboard</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('mitra.lowongan.index') }}" class="hover:text-slate-700 transition">Lowongan Saya</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-slate-700 font-medium">Tambah Lowongan</span>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Tambah Lowongan Baru</h1>
            <p class="text-sm text-slate-500 mt-1">Lengkapi detail lowongan. Setelah disimpan, lowongan akan menunggu persetujuan admin sebelum tampil di website.</p>
        </div>
        <a href="{{ route('mitra.lowongan.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    {{-- Info Banner --}}
    <div class="mb-5 flex items-start gap-3 p-4 rounded-xl bg-blue-50 border border-blue-100 max-w-4xl">
        <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div class="text-xs text-blue-800 leading-relaxed">
            <span class="font-semibold">Alur Persetujuan:</span> Setelah Anda menyimpan lowongan, tim admin BKK akan meninjau kelengkapan data. Jika disetujui, lowongan akan langsung tampil di halaman publik dan dapat dilamar oleh alumni.
        </div>
    </div>

    {{-- Form Container --}}
    <div class="max-w-4xl">
        <form method="POST" action="{{ route('mitra.lowongan.store') }}">
            @csrf
            @include('mitra.lowongan._form')
        </form>
    </div>

</x-layouts.mitra>