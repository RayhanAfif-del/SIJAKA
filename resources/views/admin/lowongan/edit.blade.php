<x-layouts.admin title="Edit Lowongan">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-700 transition">Dashboard</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.lowongan.index') }}" class="hover:text-slate-700 transition">Kelola Lowongan</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-slate-700 font-medium">Edit Lowongan</span>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Edit Lowongan</h1>
            <p class="text-sm text-slate-500 mt-1">
                Lowongan dari <span class="font-medium text-slate-700">{{ $lowongan->mitra->nama_perusahaan }}</span>. 
                Anda hanya dapat mengubah <span class="font-medium text-slate-700">posisi</span>, <span class="font-medium text-slate-700">lokasi</span>, dan <span class="font-medium text-slate-700">status unggulan</span>.
            </p>
        </div>
        <a href="{{ route('admin.lowongan.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.lowongan.update', $lowongan) }}">
        @csrf
        @method('PUT')

        <div class="grid lg:grid-cols-3 gap-5 max-w-6xl">

            {{-- Form Panel --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Section 1: Informasi Lowongan --}}
                <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-semibold text-slate-900">Informasi Lowongan</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Data utama yang dapat Anda ubah</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6 space-y-5">
                        <div class="grid sm:grid-cols-2 gap-5">
                            {{-- Posisi --}}
                            <div>
                                <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    Posisi
                                    <span class="text-xs font-normal text-red-500 ml-1">*</span>
                                </label>
                                <input type="text" name="posisi" value="{{ old('posisi', $lowongan->posisi) }}" required
                                    class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                                    placeholder="Contoh: Frontend Developer">
                                @error('posisi') 
                                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p> 
                                @enderror
                            </div>

                            {{-- Lokasi --}}
                            <div>
                                <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Lokasi
                                    <span class="text-xs font-normal text-red-500 ml-1">*</span>
                                </label>
                                <input type="text" name="lokasi" value="{{ old('lokasi', $lowongan->lokasi) }}" required
                                    class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                                    placeholder="Contoh: Jakarta Selatan">
                                @error('lokasi') 
                                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p> 
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section 2: Pengaturan Tampilan --}}
                <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-semibold text-slate-900">Pengaturan Tampilan</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Atur bagaimana lowongan ini ditampilkan di beranda</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6">
                        <input type="hidden" name="unggulan" value="0">
                        <label for="unggulan" class="group flex items-start gap-3.5 p-4 rounded-lg border border-slate-200 bg-slate-50/30 hover:bg-slate-50 hover:border-slate-300 cursor-pointer transition">
                            <input type="checkbox" id="unggulan" name="unggulan" value="1" @checked(old('unggulan', $lowongan->unggulan))
                                class="mt-0.5 w-4 h-4 rounded border-slate-300 text-amber-500 focus:ring-2 focus:ring-amber-500/20 cursor-pointer">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-slate-900">Tampilkan sebagai lowongan unggulan</span>
                                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                    Lowongan unggulan akan ditampilkan di bagian prioritas pada halaman beranda sehingga lebih mudah dilihat oleh pengunjung.
                                </p>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Section 3: Info Tambahan (Readonly) --}}
                <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-sm font-semibold text-slate-900">Informasi Tambahan</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Data readonly yang diisi oleh mitra</p>
                            </div>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-slate-100 text-[10px] font-medium text-slate-500 uppercase tracking-wider">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Readonly
                            </span>
                        </div>
                    </div>

                    <div class="p-5 sm:p-6">
                        <div class="grid sm:grid-cols-3 gap-3">
                            {{-- Jenis Pekerjaan --}}
                            <div class="p-3 rounded-lg bg-slate-50 border border-slate-100">
                                <div class="flex items-center gap-1.5 mb-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-[11px] font-medium text-slate-500 uppercase tracking-wider">Jenis</span>
                                </div>
                                <p class="text-sm font-semibold text-slate-900">{{ $lowongan->jenis_pekerjaan }}</p>
                            </div>

                            {{-- Deadline --}}
                            <div class="p-3 rounded-lg bg-slate-50 border border-slate-100">
                                <div class="flex items-center gap-1.5 mb-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-[11px] font-medium text-slate-500 uppercase tracking-wider">Deadline</span>
                                </div>
                                <p class="text-sm font-semibold text-slate-900">{{ $lowongan->deadline->translatedFormat('d F Y') }}</p>
                            </div>

                            {{-- Status --}}
                            <div class="p-3 rounded-lg bg-slate-50 border border-slate-100">
                                <div class="flex items-center gap-1.5 mb-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-[11px] font-medium text-slate-500 uppercase tracking-wider">Status</span>
                                </div>
                                @php
                                    $statusStyle = match($lowongan->status) {
                                        'disetujui' => 'bg-emerald-100 text-emerald-700',
                                        'ditolak'   => 'bg-red-100 text-red-700',
                                        default     => 'bg-amber-100 text-amber-700',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusStyle }}">
                                    {{ ucfirst($lowongan->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-4 flex items-start gap-2.5 p-3 rounded-lg bg-blue-50 border border-blue-100">
                            <svg class="w-4 h-4 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-xs text-blue-800 leading-relaxed">
                                Untuk mengubah data di atas, silakan hubungi mitra perusahaan atau edit melalui halaman detail lowongan milik mitra.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-5 bg-white border border-slate-200/70 rounded-xl shadow-sm">
                    <p class="text-xs text-slate-500 flex items-start gap-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Perubahan akan langsung diterapkan pada lowongan ini.
                    </p>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.lowongan.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">Batal</a>
                        <button type="submit" class="inline-flex items-center gap-1.5 px-5 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>

            {{-- Sidebar: Lowongan Preview --}}
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-5 space-y-4">
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-6 h-6 rounded-md bg-blue-100 text-blue-600 flex items-center justify-center">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-900">Preview Lowongan</h3>
                    </div>

                    {{-- Preview Card --}}
                    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                        <div class="p-5">
                            <div class="flex items-start gap-3 mb-4">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-violet-50 to-violet-100 flex items-center justify-center text-violet-600 text-[10px] font-bold overflow-hidden shrink-0 ring-1 ring-violet-200/50">
                                    @if ($lowongan->mitra->logo)
                                        <img src="{{ Storage::url($lowongan->mitra->logo) }}" class="w-full h-full object-cover" alt="">
                                    @else
                                        {{ strtoupper(substr($lowongan->mitra->nama_perusahaan, 0, 2)) }}
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs text-slate-500">{{ $lowongan->mitra->nama_perusahaan }}</p>
                                    <h4 class="text-sm font-semibold text-slate-900 line-clamp-2 mt-0.5" id="previewPosisi">
                                        {{ $lowongan->posisi }}
                                    </h4>
                                </div>
                            </div>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center gap-2 text-xs text-slate-600">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span id="previewLokasi">{{ $lowongan->lokasi }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-slate-600">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $lowongan->jenis_pekerjaan }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-slate-600">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $lowongan->deadline->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $statusStyle }}">
                                    {{ ucfirst($lowongan->status) }}
                                </span>
                                <span id="previewUnggulan" class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $lowongan->unggulan ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-500' }}">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    {{ $lowongan->unggulan ? 'Unggulan' : 'Reguler' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Info Card --}}
                    <div class="bg-amber-50 border border-amber-100 rounded-xl p-4">
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-amber-900 mb-1">Perhatian</p>
                                <p class="text-xs text-amber-700/80 leading-relaxed">
                                    Perubahan pada lowongan ini akan langsung terlihat oleh calon pelamar. Pastikan data yang diubah sudah benar.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Live Preview Script --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const posisiInput = document.querySelector('input[name="posisi"]');
            const lokasiInput = document.querySelector('input[name="lokasi"]');
            const unggulanInput = document.querySelector('input[name="unggulan"]');
            
            const previewPosisi = document.getElementById('previewPosisi');
            const previewLokasi = document.getElementById('previewLokasi');
            const previewUnggulan = document.getElementById('previewUnggulan');

            if (posisiInput && previewPosisi) {
                posisiInput.addEventListener('input', function () {
                    previewPosisi.textContent = this.value || 'Posisi lowongan';
                });
            }

            if (lokasiInput && previewLokasi) {
                lokasiInput.addEventListener('input', function () {
                    previewLokasi.textContent = this.value || 'Lokasi lowongan';
                });
            }

            if (unggulanInput && previewUnggulan) {
                unggulanInput.addEventListener('change', function () {
                    if (this.checked) {
                        previewUnggulan.className = 'inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-amber-100 text-amber-700';
                        previewUnggulan.innerHTML = '<svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg> Unggulan';
                    } else {
                        previewUnggulan.className = 'inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-500';
                        previewUnggulan.innerHTML = '<svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg> Reguler';
                    }
                });
            }
        });
    </script>
    @endpush

</x-layouts.admin>