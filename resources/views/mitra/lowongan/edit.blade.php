<x-layouts.mitra title="Edit Lowongan">

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
                <span class="text-slate-700 font-medium">Edit Lowongan</span>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Edit Lowongan</h1>
            <p class="text-sm text-slate-500 mt-1">Perbarui lowongan <span class="font-medium text-slate-700">"{{ $lowongan->posisi }}"</span>. Perubahan akan mengembalikan status ke "Menunggu Persetujuan".</p>
        </div>
        <a href="{{ route('mitra.lowongan.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    {{-- Form Container --}}
    <div class="max-w-4xl">
        <form method="POST" action="{{ route('mitra.lowongan.update', $lowongan) }}">
            @csrf
            @method('PUT')
            @include('mitra.lowongan._form')
        </form>
    </div>

</x-layouts.mitra>