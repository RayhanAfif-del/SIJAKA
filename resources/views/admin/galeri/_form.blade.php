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
            <div x-data="kategoriManager()">
                <div class="flex items-center justify-between mb-1.5 flex-wrap gap-2">
                    <label for="selectKategori" class="flex items-center gap-1.5 text-sm font-medium text-slate-700">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Kategori Kegiatan
                        <span class="text-xs font-normal text-red-500 ml-1">*</span>
                    </label>
                    <div class="flex items-center gap-2">
                        <button type="button" @click="openModal = true" class="inline-flex items-center gap-1 text-xs font-medium text-blue-600 hover:text-blue-700 hover:underline">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            + Tambah Kategori Baru
                        </button>
                        <span class="text-slate-300">|</span>
                        <a href="{{ route('admin.kategori-galeri.index') }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-medium text-slate-500 hover:text-slate-700 hover:underline" title="Buka kelola kategori di tab baru">
                            Kelola Kategori
                            <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                </div>

                <select name="kategori" id="selectKategori" x-ref="selectKategori" required
                    class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition bg-white">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoriList as $kat)
                        <option value="{{ $kat->nama }}" {{ old('kategori', $galeri->kategori ?? '') == $kat->nama ? 'selected' : '' }}>
                            {{ $kat->nama }}
                        </option>
                    @endforeach
                </select>

                {{-- Quick Suggestion Chips from Database --}}
                @if (isset($kategoriList) && $kategoriList->isNotEmpty())
                    <div class="mt-2.5">
                        <p class="text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1.5">Pilihan Cepat:</p>
                        <div class="flex flex-wrap gap-1.5" id="kategoriBadgesContainer">
                            @foreach ($kategoriList as $kat)
                                <button type="button" 
                                        @click="selectCategory('{{ $kat->nama }}')"
                                        :class="selectedKategori === '{{ $kat->nama }}' ? 'bg-blue-100 text-blue-700 border-blue-200' : 'bg-slate-100 text-slate-600 border-transparent hover:bg-blue-50 hover:text-blue-700 hover:border-blue-200'"
                                        class="kategori-chip inline-flex items-center px-3 py-1.5 text-xs font-medium border rounded-full transition cursor-pointer"
                                        data-kategori="{{ $kat->nama }}">
                                    {{ $kat->nama }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                @error('kategori') 
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p> 
                @enderror

                {{-- Modal Tambah Kategori Baru Cepat --}}
                <div x-show="openModal" 
                     x-cloak
                     class="fixed inset-0 z-50 overflow-y-auto"
                     aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div x-show="openModal" 
                             x-transition:enter="ease-out duration-300"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="ease-in duration-200"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             @click="openModal = false"
                             class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" 
                             aria-hidden="true"></div>

                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                        <div x-show="openModal" 
                             x-transition:enter="ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave="ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-slate-100">
                            
                            <div class="p-6">
                                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                                    <h3 class="text-base font-semibold text-slate-900 flex items-center gap-2">
                                        <span class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        </span>
                                        Tambah Kategori Baru
                                    </h3>
                                    <button type="button" @click="openModal = false" class="text-slate-400 hover:text-slate-600 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>

                                <template x-if="errorMessage">
                                    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-xs text-red-600 font-medium flex items-center gap-1.5">
                                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        <span x-text="errorMessage"></span>
                                    </div>
                                </template>

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs font-medium text-slate-700 mb-1">
                                            Nama Kategori <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" x-model="newNama" @keydown.enter.prevent="submitCategory()"
                                               placeholder="Contoh: Dies Natalis, LKS, Wisuda..."
                                               class="w-full text-sm rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-700 mb-1">
                                            Deskripsi Singkat (Opsional)
                                        </label>
                                        <textarea x-model="newDeskripsi" rows="2"
                                                  placeholder="Keterangan singkat kategori..."
                                                  class="w-full text-sm rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition"></textarea>
                                    </div>
                                </div>

                                <div class="mt-6 flex items-center justify-end gap-2.5">
                                    <button type="button" @click="openModal = false"
                                            class="px-4 py-2 text-xs font-medium text-slate-600 hover:text-slate-800 bg-slate-100 hover:bg-slate-200 rounded-lg transition">
                                        Batal
                                    </button>
                                    <button type="button" @click="submitCategory()" :disabled="isLoading"
                                            class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition disabled:opacity-50">
                                        <svg x-show="isLoading" class="animate-spin -ml-0.5 mr-1 h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span x-text="isLoading ? 'Menyimpan...' : 'Simpan Kategori'"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-5 bg-white border border-slate-200/70 rounded-xl shadow-sm">
        <p class="text-xs text-slate-500 flex items-start gap-1.5">
            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Foto akan langsung tampil di halaman galeri publik setelah disimpan.
        </p>
        <div class="admin-form-actions">
            <a href="{{ route('admin.galeri.index') }}" class="btn-secondary w-full sm:w-auto justify-center">Batal</a>
            <button type="submit" class="btn-primary w-full sm:w-auto justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Foto
            </button>
        </div>
    </div>

</div>

{{-- Category & Preview Script --}}
@push('scripts')
<script>
    function kategoriManager() {
        return {
            openModal: false,
            newNama: '',
            newDeskripsi: '',
            isLoading: false,
            errorMessage: '',
            selectedKategori: @json(old('kategori', $galeri->kategori ?? '')),
            init() {
                if (this.$refs.selectKategori) {
                    this.$refs.selectKategori.addEventListener('change', (e) => {
                        this.selectedKategori = e.target.value;
                    });
                }
            },
            selectCategory(name) {
                this.selectedKategori = name;
                if (this.$refs.selectKategori) {
                    this.$refs.selectKategori.value = name;
                }
            },
            async submitCategory() {
                if (!this.newNama.trim()) {
                    this.errorMessage = 'Nama kategori wajib diisi.';
                    return;
                }
                this.isLoading = true;
                this.errorMessage = '';
                try {
                    const response = await fetch("{{ route('admin.kategori-galeri.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            nama: this.newNama.trim(),
                            deskripsi: this.newDeskripsi.trim()
                        })
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        this.errorMessage = result.message || (result.errors && Object.values(result.errors)[0][0]) || 'Gagal menambahkan kategori.';
                        this.isLoading = false;
                        return;
                    }

                    // Add option to select dropdown
                    const select = this.$refs.selectKategori;
                    const newOpt = document.createElement('option');
                    newOpt.value = result.data.nama;
                    newOpt.textContent = result.data.nama;
                    newOpt.selected = true;
                    select.appendChild(newOpt);

                    this.selectedKategori = result.data.nama;
                    this.newNama = '';
                    this.newDeskripsi = '';
                    this.openModal = false;

                    // Append badge to quick selection container
                    const badgesContainer = document.getElementById('kategoriBadgesContainer');
                    if (badgesContainer) {
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.className = 'kategori-chip inline-flex items-center px-3 py-1.5 text-xs font-medium border rounded-full transition cursor-pointer bg-blue-100 text-blue-700 border-blue-200';
                        btn.textContent = result.data.nama;
                        btn.onclick = () => this.selectCategory(result.data.nama);
                        badgesContainer.appendChild(btn);
                    }
                } catch (err) {
                    this.errorMessage = 'Terjadi kesalahan sistem saat menyimpan kategori.';
                } finally {
                    this.isLoading = false;
                }
            }
        };
    }

    document.addEventListener('DOMContentLoaded', function () {
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
