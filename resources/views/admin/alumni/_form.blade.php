<div class="space-y-5 max-w-4xl mx-auto">
    
    {{-- Section 1: Informasi Pribadi --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Informasi Pribadi</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Data identitas alumni</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6">
            <div>
                <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Nama Lengkap
                    <span class="text-xs font-normal text-red-500 ml-1">*</span>
                </label>
                <input type="text" name="nama" value="{{ old('nama', $alumni->nama ?? '') }}" required
                    class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                    placeholder="Masukkan nama lengkap alumni">
                <p class="mt-1.5 text-xs text-slate-500">Gunakan nama sesuai ijazah untuk memudahkan pelacakan.</p>
                @error('nama') 
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p> 
                @enderror
            </div>
        </div>
    </div>

    {{-- Section 2: Pendidikan --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Informasi Pendidikan</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Jurusan dan tahun kelulusan</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6">
            <div class="grid sm:grid-cols-2 gap-5">
                {{-- Jurusan --}}
                <div class="sm:col-span-2">
                    <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Jurusan
                        <span class="text-xs font-normal text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" name="jurusan" value="{{ old('jurusan', $alumni->jurusan ?? '') }}" required
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                        placeholder="Contoh: Teknik Informatika, Akuntansi, dll">
                    @error('jurusan') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>

                {{-- Tahun Lulus --}}
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Tahun Lulus
                        <span class="text-xs font-normal text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" name="tahun_lulus" value="{{ old('tahun_lulus', $alumni->tahun_lulus ?? '') }}" required maxlength="4" pattern="[0-9]{4}"
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"
                        placeholder="2024" inputmode="numeric">
                    <p class="mt-1.5 text-xs text-slate-500">Masukkan 4 digit tahun (contoh: 2024).</p>
                    @error('tahun_lulus') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Section 3: Status Karir --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Status Karir</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Kondisi terkini alumni setelah lulus</p>
                </div>
            </div>
        </div>

        <div class="p-5 sm:p-6">
            <div class="grid sm:grid-cols-2 gap-5 items-start">
                {{-- Select Status --}}
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Status Saat Ini
                        <span class="text-xs font-normal text-red-500 ml-1">*</span>
                    </label>
                    <select name="status" id="selectStatus" required
                        class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition bg-white">
                        @foreach (['Bekerja', 'Berwirausaha', 'Melanjutkan Studi', 'Belum Bekerja'] as $status)
                            <option value="{{ $status }}" @selected(old('status', $alumni->status ?? '') === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                    @error('status') 
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>

                {{-- Live Preview Badge --}}
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Preview Tampilan
                    </label>
                    <div class="p-4 rounded-lg border border-slate-200 bg-slate-50/50">
                        <p class="text-xs text-slate-500 mb-2">Badge yang akan tampil di tabel data alumni:</p>
                        <span id="statusPreview" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span id="statusDot" class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span id="statusText">Bekerja</span>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Status Description --}}
            <div class="mt-5 grid sm:grid-cols-2 xl:grid-cols-4 gap-2.5">
                <div class="p-3 rounded-lg bg-emerald-50/50 border border-emerald-100">
                    <div class="flex items-center gap-1.5 mb-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span class="text-xs font-semibold text-emerald-900">Bekerja</span>
                    </div>
                    <p class="text-[11px] text-emerald-700/80 leading-relaxed">Alumni yang saat ini bekerja di perusahaan/instansi.</p>
                </div>
                <div class="p-3 rounded-lg bg-violet-50/50 border border-violet-100">
                    <div class="flex items-center gap-1.5 mb-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-violet-500"></span>
                        <span class="text-xs font-semibold text-violet-900">Berwirausaha</span>
                    </div>
                    <p class="text-[11px] text-violet-700/80 leading-relaxed">Alumni yang menjalankan usaha sendiri atau berwirausaha.</p>
                </div>
                <div class="p-3 rounded-lg bg-blue-50/50 border border-blue-100">
                    <div class="flex items-center gap-1.5 mb-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                        <span class="text-xs font-semibold text-blue-900">Melanjutkan Studi</span>
                    </div>
                    <p class="text-[11px] text-blue-700/80 leading-relaxed">Alumni yang melanjutkan ke jenjang pendidikan lebih tinggi.</p>
                </div>
                <div class="p-3 rounded-lg bg-amber-50/50 border border-amber-100">
                    <div class="flex items-center gap-1.5 mb-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        <span class="text-xs font-semibold text-amber-900">Belum Bekerja</span>
                    </div>
                    <p class="text-[11px] text-amber-700/80 leading-relaxed">Alumni yang masih mencari pekerjaan atau belum bekerja.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-sm font-semibold text-slate-900">Akun Direktori Talenta</h2>
            <p class="text-xs text-slate-500 mt-0.5">Kredensial ini digunakan alumni untuk mengelola profil dan dokumen.</p>
        </div>
        <div class="p-5 sm:p-6 grid sm:grid-cols-2 gap-5">
            <div>
                <label class="text-sm font-medium text-slate-700">Email Alumni</label>
                <input type="email" name="email" value="{{ old('email', $alumni->email ?? '') }}" class="mt-1.5 w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm" placeholder="alumni@email.com">
                @error('email')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Password {{ isset($alumni) ? '(kosongkan jika tidak diubah)' : '' }}</label>
                <input type="password" name="password" minlength="8" class="mt-1.5 w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm" placeholder="Minimal 8 karakter">
                @error('password')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    {{-- Section 4: Aksi --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-5 bg-white border border-slate-200/70 rounded-xl shadow-sm">
        <p class="text-xs text-slate-500 flex items-start gap-1.5">
            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Data alumni akan digunakan untuk statistik penyerapan kerja dan tracer study.
        </p>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.alumni.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">Batal</a>
            <button type="submit" class="inline-flex items-center gap-1.5 px-5 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Data
            </button>
        </div>
    </div>

</div>

{{-- Live Status Preview Script --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectStatus = document.getElementById('selectStatus');
        const statusPreview = document.getElementById('statusPreview');
        const statusDot = document.getElementById('statusDot');
        const statusText = document.getElementById('statusText');

        const statusStyles = {
            'Bekerja': {
                bg: 'bg-emerald-50',
                text: 'text-emerald-700',
                border: 'border-emerald-200',
                dot: 'bg-emerald-500'
            },
            'Berwirausaha': {
                bg: 'bg-violet-50',
                text: 'text-violet-700',
                border: 'border-violet-200',
                dot: 'bg-violet-500'
            },
            'Melanjutkan Studi': {
                bg: 'bg-blue-50',
                text: 'text-blue-700',
                border: 'border-blue-200',
                dot: 'bg-blue-500'
            },
            'Belum Bekerja': {
                bg: 'bg-amber-50',
                text: 'text-amber-700',
                border: 'border-amber-200',
                dot: 'bg-amber-500'
            }
        };

        function updatePreview() {
            const selected = selectStatus.value;
            const style = statusStyles[selected] || statusStyles['Belum Bekerja'];

            // Reset classes
            statusPreview.className = 'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium border ' + style.bg + ' ' + style.text + ' ' + style.border;
            statusDot.className = 'w-1.5 h-1.5 rounded-full ' + style.dot;
            statusText.textContent = selected;
        }

        if (selectStatus) {
            selectStatus.addEventListener('change', updatePreview);
            // Initial update
            updatePreview();
        }
    });
</script>
@endpush