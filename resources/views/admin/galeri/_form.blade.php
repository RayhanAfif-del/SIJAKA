<div class="space-y-5 max-w-4xl mx-auto">
    @php
        $isEdit = isset($galeri) && !empty($galeri->exists);
    @endphp
    
    {{-- Section 1: Informasi Kegiatan --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Informasi Kegiatan</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Judul dan kategori untuk pengelompokan foto</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6 space-y-5">
            {{-- Judul --}}
            <div>
                <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                    Judul Kegiatan
                    <span class="text-xs font-normal text-red-500 ml-1">*</span>
                </label>
                <input type="text" name="judul" value="{{ old('judul', $galeri->judul ?? '') }}" required
                    class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                    placeholder="Contoh: Workshop CV & Interview Preparation">
                <p class="mt-1.5 text-xs text-slate-500">Gunakan judul yang deskriptif dan mudah dipahami, maksimal 100 karakter.</p>
                @error('judul') 
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p> 
                @enderror
            </div>

            {{-- Kategori --}}
            <div>
                <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Kategori
                    <span class="text-xs font-normal text-red-500 ml-1">*</span>
                </label>
                <input type="text" name="kategori" id="inputKategori" value="{{ old('kategori', $galeri->kategori ?? '') }}" required
                    class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                    placeholder="Pilih atau ketik kategori...">
                
                {{-- Quick Suggestion Chips --}}
                <div class="mt-2.5">
                    <p class="text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1.5">Saran Kategori:</p>
                    <div class="flex flex-wrap gap-1.5">
                        @php
                            $kategoriSaran = ['Workshop', 'Seminar', 'Kunjungan Industri', 'Job Fair', 'Training', 'Sosialisasi', 'Kegiatan Lain'];
                        @endphp
                        @foreach ($kategoriSaran as $saran)
                            <button type="button" 
                                    class="kategori-chip inline-flex items-center px-2.5 py-1 text-xs font-medium text-slate-600 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 border border-transparent hover:border-blue-200 rounded-full transition cursor-pointer"
                                    data-kategori="{{ $saran }}">
                                {{ $saran }}
                            </button>
                        @endforeach
                    </div>
                </div>
                @error('kategori') 
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p> 
                @enderror
            </div>
        </div>
    </div>

    {{-- Section 2: Tanggal Kegiatan --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Tanggal Kegiatan</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Kapan kegiatan ini dilaksanakan</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6">
            <div class="max-w-xs">
                <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Tanggal
                    <span class="text-xs font-normal text-red-500 ml-1">*</span>
                </label>
                <input type="date" name="tanggal" value="{{ old('tanggal', isset($galeri) ? $galeri->tanggal->format('Y-m-d') : '') }}" required
                    class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition">
                <p class="mt-1.5 text-xs text-slate-500">Pilih tanggal pelaksanaan kegiatan untuk pengarsipan yang rapi.</p>
                @error('tanggal') 
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p> 
                @enderror
            </div>
        </div>
    </div>

    {{-- Section 3: Foto Kegiatan --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Foto Kegiatan</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Dokumentasi visual yang akan ditampilkan di galeri</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-start gap-5 p-4 rounded-lg border border-dashed border-slate-200 bg-slate-50/50">
                {{-- Preview Foto --}}
                <div class="w-full sm:w-64 rounded-xl border border-slate-200 bg-white overflow-hidden shrink-0 shadow-sm">
                    @if ($isEdit && !empty($galeri->foto))
                        <img src="{{ Storage::url($galeri->foto) }}" alt="Foto Kegiatan" class="w-full h-full object-cover aspect-[4/3]">
                    @else
                        <div class="p-4">
                            <div id="fotoPreviewEmpty" class="aspect-[4/3] rounded-lg border border-dashed border-slate-200 bg-slate-50 flex flex-col items-center justify-center text-center p-4">
                                <svg class="w-10 h-10 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-xs font-medium text-slate-400">
                                    {{ $isEdit ? 'Belum ada foto baru' : 'Belum ada foto dipilih' }}
                                </span>
                            </div>
                            @if (! $isEdit)
                                <div id="fotoPreviewList" class="hidden mt-3 grid grid-cols-2 gap-2"></div>
                                <p id="fotoPreviewCount" class="hidden mt-2 text-[11px] text-slate-500"></p>
                            @endif
                        </div>
                    @endif
                </div>
                
                {{-- Upload Area --}}
                    <div class="flex-1 min-w-0">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        {{ $isEdit ? 'Unggah Foto Baru' : 'Unggah Foto' }}
                    </label>
                    <input
                        type="file"
                        name="{{ $isEdit ? 'foto' : 'foto[]' }}"
                        id="fotoInput"
                        accept="image/*"
                        {{ $isEdit ? '' : 'multiple' }}
                        class="block w-full text-sm text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:text-sm file:font-medium hover:file:bg-blue-100 file:cursor-pointer file:transition">
                    <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                        <span class="font-medium text-slate-700">Rekomendasi:</span>
                        {{ $isEdit ? 'Unggah 1 foto baru untuk mengganti foto lama.' : 'Bisa pilih lebih dari 1 foto sekaligus. Setiap foto akan disimpan sebagai item galeri terpisah dalam satu event.' }}
                        Format JPG/PNG, ukuran maksimal 2MB per foto.
                    </p>
                    @error('foto')
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                    @error('foto.*')
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Section 4: Aksi --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-5 bg-white border border-slate-200/70 rounded-xl shadow-sm">
        <p class="text-xs text-slate-500 flex items-start gap-1.5">
            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Foto akan langsung tampil di halaman galeri publik setelah disimpan.
        </p>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.galeri.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">Batal</a>
            <button type="submit" class="inline-flex items-center gap-1.5 px-5 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Foto
            </button>
        </div>
    </div>

</div>

{{-- Category Chips Script --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chips = document.querySelectorAll('.kategori-chip');
        const inputKategori = document.getElementById('inputKategori');

        chips.forEach(chip => {
            chip.addEventListener('click', function () {
                if (inputKategori) {
                    inputKategori.value = this.dataset.kategori;
                    inputKategori.focus();

                    chips.forEach(c => c.classList.remove('bg-blue-100', 'text-blue-700', 'border-blue-200'));
                    this.classList.add('bg-blue-100', 'text-blue-700', 'border-blue-200');
                }
            });
        });

        if (inputKategori && inputKategori.value) {
            chips.forEach(chip => {
                if (chip.dataset.kategori === inputKategori.value) {
                    chip.classList.add('bg-blue-100', 'text-blue-700', 'border-blue-200');
                }
            });
        }

        const fotoInput = document.getElementById('fotoInput');
        const fotoPreviewEmpty = document.getElementById('fotoPreviewEmpty');
        const fotoPreviewList = document.getElementById('fotoPreviewList');
        const fotoPreviewCount = document.getElementById('fotoPreviewCount');

        if (fotoInput && fotoInput.multiple && fotoPreviewEmpty && fotoPreviewList && fotoPreviewCount) {
            fotoInput.addEventListener('change', function () {
                const files = Array.from(this.files || []);

                if (!files.length) {
                    fotoPreviewEmpty.classList.remove('hidden');
                    fotoPreviewList.classList.add('hidden');
                    fotoPreviewList.innerHTML = '';
                    fotoPreviewCount.classList.add('hidden');
                    fotoPreviewCount.textContent = '';
                    const label = fotoPreviewEmpty.querySelector('span');
                    if (label) {
                        label.textContent = 'Belum ada foto dipilih';
                    }
                    return;
                }

                fotoPreviewEmpty.classList.add('hidden');
                fotoPreviewList.classList.remove('hidden');
                fotoPreviewCount.classList.remove('hidden');
                fotoPreviewCount.textContent = `${files.length} foto dipilih`;
                fotoPreviewList.innerHTML = '';

                files.forEach((file) => {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        const wrapper = document.createElement('div');
                        wrapper.className = 'aspect-square rounded-lg overflow-hidden border border-slate-200 bg-slate-50';
                        wrapper.innerHTML = `<img src="${event.target.result}" alt="${file.name}" class="w-full h-full object-cover">`;
                        fotoPreviewList.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                });
            });
        }
    });
</script>
@endpush
