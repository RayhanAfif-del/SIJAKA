<x-layouts.admin title="Kategori Galeri">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2 flex-wrap">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-700 transition">Dashboard</a>
                <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('admin.galeri.index') }}" class="hover:text-slate-700 transition">Galeri Kegiatan</a>
                <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-slate-700 font-medium">Kelola Kategori</span>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Kategori Galeri</h1>
            <p class="text-sm text-slate-500 mt-1">Buat dan kelola pilihan kategori yang akan muncul saat menambahkan foto kegiatan.</p>
        </div>
        <div class="flex items-center gap-2 sm:gap-2.5 w-full sm:w-auto">
            <a href="{{ route('admin.galeri.index') }}" class="btn-secondary flex-1 sm:flex-none justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Galeri
            </a>
            <a href="{{ route('admin.galeri.create') }}" class="btn-primary flex-1 sm:flex-none justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Tambah Foto
            </a>
        </div>
    </div>

    {{-- Main Grid: Form Tambah (Kiri) & Daftar Kategori (Kanan) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start" x-data="{
        editModalOpen: false,
        editId: null,
        editNama: '',
        editDeskripsi: '',
        openEdit(id, nama, deskripsi) {
            this.editId = id;
            this.editNama = nama;
            this.editDeskripsi = deskripsi || '';
            this.editModalOpen = true;
        }
    }">

        {{-- Kolom Kiri: Form Tambah Kategori Baru --}}
        <div class="lg:col-span-1 bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Tambah Kategori Baru</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Kategori ini otomatis tersedia di form galeri</p>
                </div>
            </div>

            <form action="{{ route('admin.kategori-galeri.store') }}" method="POST" class="p-5 space-y-4">
                @csrf
                <div>
                    <label for="nama" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                           placeholder="Contoh: Lomba Kompetensi Siswa"
                           class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition">
                    @error('nama')
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="deskripsi" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                        Deskripsi / Keterangan <span class="text-slate-400 font-normal lowercase">(opsional)</span>
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="2"
                              placeholder="Keterangan singkat tentang kategori ini..."
                              class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full btn-primary justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>

        {{-- Kolom Kanan: Tabel / List Daftar Kategori --}}
        <div class="lg:col-span-2 space-y-4">
            {{-- Table Card --}}
            <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-slate-50/30">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-900">Daftar Kategori Tersedia</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Total {{ $kategori->total() }} kategori terdaftar</p>
                    </div>

                    {{-- Form Pencarian Terpadu di Header Tabel --}}
                    <form method="GET" action="{{ route('admin.kategori-galeri.index') }}" class="flex items-center gap-2 w-full sm:w-auto">
                        <div class="relative flex-1 sm:w-64">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama kategori..."
                                   class="w-full pl-9 pr-3 py-2 rounded-lg border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-xs transition outline-none">
                        </div>
                        <button type="submit" class="btn-secondary !min-h-0 py-2 px-3 text-xs shrink-0">
                            Cari
                        </button>
                        @if (request()->filled('cari'))
                            <a href="{{ route('admin.kategori-galeri.index') }}" class="p-2 rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 transition shrink-0" title="Reset pencarian">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50/75 border-b border-slate-100 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <tr>
                                <th class="px-4 sm:px-5 py-3.5 w-12 text-center">#</th>
                                <th class="px-4 sm:px-5 py-3.5">Nama Kategori</th>
                                <th class="px-4 sm:px-5 py-3.5 text-center">Jumlah Foto</th>
                                <th class="px-4 sm:px-5 py-3.5 text-right whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($kategori as $index => $item)
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-4 sm:px-5 py-3.5 text-center text-xs text-slate-400 font-medium">
                                        {{ $kategori->firstItem() + $index }}
                                    </td>
                                    <td class="px-4 sm:px-5 py-3.5">
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                                {{ $item->nama }}
                                            </span>
                                        </div>
                                        @if ($item->deskripsi)
                                            <p class="text-xs text-slate-400 mt-1 line-clamp-1">{{ $item->deskripsi }}</p>
                                        @endif
                                    </td>
                                    <td class="px-4 sm:px-5 py-3.5 text-center">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium {{ $item->galeri_count > 0 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-500' }}">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $item->galeri_count }} Foto
                                        </span>
                                    </td>
                                    <td class="px-4 sm:px-5 py-3.5 text-right whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-1.5">
                                            <button type="button"
                                                    @click="openEdit({{ $item->id }}, '{{ addslashes($item->nama) }}', '{{ addslashes($item->deskripsi ?? '') }}')"
                                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200 text-xs font-medium text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition"
                                                    title="Edit Kategori">
                                                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </button>

                                            <form action="{{ route('admin.kategori-galeri.destroy', $item) }}" method="POST"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori \'{{ $item->nama }}\'?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-red-200 text-xs font-medium text-red-600 hover:bg-red-50 transition"
                                                        title="Hapus Kategori">
                                                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-12 text-center">
                                        <div class="max-w-xs mx-auto">
                                            <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                </svg>
                                            </div>
                                            <p class="text-sm font-semibold text-slate-800">Belum ada kategori</p>
                                            <p class="text-xs text-slate-500 mt-1">Gunakan formulir di atas untuk menambahkan kategori kegiatan baru.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($kategori->hasPages())
                    <div class="px-5 py-4 border-t border-slate-100">
                        {{ $kategori->links() }}
                    </div>
                @endif
            </div>
        </div>

        {{-- Modal Edit Kategori --}}
        <div x-show="editModalOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="editModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" @click="editModalOpen = false" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="editModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-slate-200">
                    
                    <form :action="'{{ url('admin/kategori-galeri') }}/' + editId" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="px-6 pt-6 pb-4">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                                <h3 class="text-base font-semibold text-slate-900">Edit Kategori Galeri</h3>
                                <button type="button" @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Nama Kategori <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nama" x-model="editNama" required
                                           class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition">
                                    <p class="text-[11px] text-slate-400 mt-1">Mengubah nama kategori ini akan otomatis menyinkronkan foto galeri terkait.</p>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Deskripsi / Keterangan
                                    </label>
                                    <textarea name="deskripsi" x-model="editDeskripsi" rows="3"
                                              class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm transition"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="px-6 py-4 bg-slate-50/75 border-t border-slate-100 flex items-center justify-end gap-2.5">
                            <button type="button" @click="editModalOpen = false" class="btn-secondary">
                                Batal
                            </button>
                            <button type="submit" class="btn-primary">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</x-layouts.admin>
