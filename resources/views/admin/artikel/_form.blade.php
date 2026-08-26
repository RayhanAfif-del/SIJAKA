<div class="space-y-5 max-w-4xl mx-auto">
    
    {{-- Section 1: Informasi Artikel --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Informasi Artikel</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Judul dan kategori untuk pengelompokan artikel</p>
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
                    Judul Artikel
                    <span class="text-xs font-normal text-red-500 ml-1">*</span>
                </label>
                <input type="text" name="judul" id="inputJudul" value="{{ old('judul', $artikel->judul ?? '') }}" required
                    class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                    placeholder="Contoh: 5 Tips Sukses Interview Kerja Pertama">
                <p class="mt-1.5 text-xs text-slate-500">Gunakan judul yang menarik dan jelas, maksimal 100 karakter.</p>
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
                <input type="text" name="kategori" id="inputKategori" value="{{ old('kategori', $artikel->kategori ?? '') }}" required
                    class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                    placeholder="Pilih atau ketik kategori...">
                
                {{-- Quick Suggestion Chips --}}
                <div class="mt-2.5">
                    <p class="text-[11px] font-medium text-slate-500 uppercase tracking-wider mb-1.5">Saran Kategori:</p>
                    <div class="flex flex-wrap gap-1.5">
                        @php
                            $kategoriSaran = ['Tips Karier', 'Dunia Kerja', 'Interview', 'CV & Surat Lamaran', 'Pengembangan Diri', 'Info Bursa Kerja'];
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

    {{-- Section 2: Gambar Sampul --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Gambar Sampul</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Visual utama yang tampil di daftar artikel dan halaman detail</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-start gap-5 p-4 rounded-lg border border-dashed border-slate-200 bg-slate-50/50">
                {{-- Preview Gambar --}}
                <div class="w-full sm:w-64 aspect-video rounded-xl border border-slate-200 bg-white overflow-hidden flex items-center justify-center shrink-0 shadow-sm">
                    @if (!empty($artikel->gambar))
                        <img src="{{ Storage::url($artikel->gambar) }}" alt="Gambar Sampul" class="w-full h-full object-cover">
                    @else
                        <div class="flex flex-col items-center text-center p-4">
                            <svg class="w-10 h-10 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-xs font-medium text-slate-400">Belum ada gambar</span>
                        </div>
                    @endif
                </div>
                
                {{-- Upload Area --}}
                <div class="flex-1 min-w-0">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Unggah Gambar Baru</label>
                    <input type="file" name="gambar" accept="image/*"
                        class="block w-full text-sm text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:text-sm file:font-medium hover:file:bg-blue-100 file:cursor-pointer file:transition">
                    <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                        <span class="font-medium text-slate-700">Rekomendasi:</span> Rasio 16:9 (1200×675px) format JPG/PNG, ukuran maksimal 2MB. Gunakan gambar yang relevan dengan isi artikel.
                    </p>
                    @error('gambar') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Section 3: Konten Artikel --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Konten Artikel</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Isi lengkap artikel yang akan dibaca pengunjung</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6">
            <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Isi Konten
                <span class="text-xs font-normal text-red-500 ml-1">*</span>
            </label>
            <textarea name="konten" rows="10" required
                class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition resize-y min-h-[200px]"
                placeholder="Tulis konten artikel Anda di sini...&#10;&#10;Anda dapat menggunakan format sederhana:&#10;# Judul Besar&#10;## Sub Judul&#10;**Teks Tebal**&#10;- Daftar item">{{ old('konten', $artikel->konten ?? '') }}</textarea>
            
            {{-- Formatting Guide --}}
            <div class="mt-3 flex items-start gap-2.5 p-3 rounded-lg bg-emerald-50 border border-emerald-100">
                <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-xs text-emerald-800 leading-relaxed">
                    <span class="font-semibold">Tips penulisan:</span> Tulis konten minimal 300 kata untuk artikel yang berkualitas. Gunakan paragraf pendek (2-3 kalimat) agar mudah dibaca. Pisahkan bagian dengan heading untuk struktur yang jelas.
                </div>
            </div>
            @error('konten') 
                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    {{ $message }}
                </p> 
            @enderror
        </div>
    </div>

    {{-- Section 4: Aksi --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-5 bg-white border border-slate-200/70 rounded-xl shadow-sm">
        <p class="text-xs text-slate-500 flex items-start gap-1.5">
            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Artikel akan langsung tampil di halaman publik setelah disimpan.
        </p>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.artikel.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">Batal</a>
            <button type="submit" class="inline-flex items-center gap-1.5 px-5 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Artikel
            </button>
        </div>
    </div>

</div>

{{-- Live Preview & Category Chips Script --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Category Chips Click Handler
        const chips = document.querySelectorAll('.kategori-chip');
        const inputKategori = document.getElementById('inputKategori');
        
        chips.forEach(chip => {
            chip.addEventListener('click', function () {
                if (inputKategori) {
                    inputKategori.value = this.dataset.kategori;
                    inputKategori.focus();
                    
                    // Visual feedback
                    chips.forEach(c => c.classList.remove('bg-blue-100', 'text-blue-700', 'border-blue-200'));
                    this.classList.add('bg-blue-100', 'text-blue-700', 'border-blue-200');
                }
            });
        });

        // Highlight active category chip on load
        if (inputKategori && inputKategori.value) {
            chips.forEach(chip => {
                if (chip.dataset.kategori === inputKategori.value) {
                    chip.classList.add('bg-blue-100', 'text-blue-700', 'border-blue-200');
                }
            });
        }
    });
</script>
@endpush