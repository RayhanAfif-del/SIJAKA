<x-layouts.admin title="Edit Struktur Organisasi">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-700 transition">Dashboard</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.struktur-organisasi.index') }}" class="hover:text-slate-700 transition">Struktur Organisasi</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-slate-700 font-medium">Edit Pengurus</span>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Edit Data Pengurus</h1>
            <p class="text-sm text-slate-500 mt-1">Perbarui informasi <span class="font-medium text-slate-700">{{ $strukturOrganisasi->nama }}</span> di bawah ini.</p>
        </div>
        <a href="{{ route('admin.struktur-organisasi.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    {{-- Form Container --}}
    <div class="max-w-4xl">
        <form method="POST" action="{{ route('admin.struktur-organisasi.update', $strukturOrganisasi) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.struktur-organisasi._form')
        </form>
    </div>

</x-layouts.admin>