<x-layouts.public title="Profil Talenta Alumni">
    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="mb-6">
            <p class="text-xs font-semibold uppercase tracking-wider text-blue-600">Direktori Talenta Alumni</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">Profil Talenta Saya</h1>
            <p class="mt-1 text-sm text-slate-500">Lengkapi profil agar mitra dapat menemukan keahlian Anda. Kontak pribadi tidak ditampilkan.</p>
        </div>
        @if (session('status'))<div class="mb-5 rounded-lg bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>@endif
        <form method="POST" action="{{ route('alumni.profile.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div class="bg-white border border-slate-200 rounded-xl p-5 sm:p-6 space-y-5">
                <div>
                    <label class="text-sm font-medium text-slate-700">Headline profesional</label>
                    <input name="headline" value="{{ old('headline', $alumni->headline) }}" class="mt-1.5 w-full rounded-lg border-slate-200 text-sm" placeholder="Contoh: Junior Web Developer">
                    @error('headline')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-700">Ringkasan profil</label>
                    <textarea name="ringkasan" rows="4" class="mt-1.5 w-full rounded-lg border-slate-200 text-sm" placeholder="Ceritakan pengalaman dan tujuan karier Anda">{{ old('ringkasan', $alumni->ringkasan) }}</textarea>
                    @error('ringkasan')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-700">Keahlian</label>
                    <input name="keahlian" value="{{ old('keahlian', $alumni->keahlian) }}" class="mt-1.5 w-full rounded-lg border-slate-200 text-sm" placeholder="Pisahkan dengan koma, contoh: PHP, Laravel, UI Design">
                    @error('keahlian')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-700">Tautan portofolio</label>
                    <input type="url" name="portfolio_url" value="{{ old('portfolio_url', $alumni->portfolio_url) }}" class="mt-1.5 w-full rounded-lg border-slate-200 text-sm" placeholder="https://...">
                    @error('portfolio_url')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="grid sm:grid-cols-2 gap-5">
                    <div><label class="text-sm font-medium text-slate-700">CV (PDF/DOC/DOCX)</label><input type="file" name="cv" accept=".pdf,.doc,.docx" class="mt-1.5 block w-full text-sm"><p class="mt-1 text-xs text-slate-500">{{ $alumni->cv_path ? 'CV tersimpan. Upload baru untuk mengganti.' : 'Maksimal 5 MB.' }}</p>@error('cv')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
                    <div><label class="text-sm font-medium text-slate-700">Portofolio (PDF/ZIP)</label><input type="file" name="portfolio" accept=".pdf,.zip" class="mt-1.5 block w-full text-sm"><p class="mt-1 text-xs text-slate-500">{{ $alumni->portfolio_path ? 'Portofolio tersimpan. Upload baru untuk mengganti.' : 'Maksimal 10 MB.' }}</p>@error('portfolio')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
                </div>
                <label class="flex items-start gap-3"><input type="checkbox" name="is_visible" value="1" @checked(old('is_visible', $alumni->is_visible)) class="mt-1 rounded border-slate-300 text-blue-600"><span><span class="block text-sm font-medium text-slate-700">Tampilkan profil di Talent Pool</span><span class="block text-xs text-slate-500 mt-0.5">Mitra dapat melihat data profesional, tetapi tidak email atau kontak pribadi.</span></span></label>
            </div>
            <button class="inline-flex items-center rounded-lg bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-slate-800">Simpan Profil</button>
        </form>
        <div class="mt-8 bg-white border border-slate-200 rounded-xl p-5 sm:p-6">
            <h2 class="font-semibold text-slate-900">Permintaan Wawancara</h2>
            <div class="mt-4 space-y-3">
                @forelse($requests as $item)
                    <div class="border border-slate-200 rounded-lg p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3"><div><p class="text-sm font-semibold text-slate-800">{{ $item->mitra->nama_perusahaan }}</p><p class="text-xs text-slate-500 mt-1">{{ $item->message ?: 'Tidak ada pesan tambahan.' }}</p></div><div class="flex items-center gap-2"><span class="text-xs font-semibold text-slate-600">{{ ucfirst($item->status) }}</span>@if($item->status === 'pending')<form method="POST" action="{{ route('alumni.interview.respond', [$item, 'accepted']) }}">@csrf @method('PATCH')<button class="text-xs font-semibold text-emerald-700">Terima</button></form><form method="POST" action="{{ route('alumni.interview.respond', [$item, 'rejected']) }}">@csrf @method('PATCH')<button class="text-xs font-semibold text-red-700">Tolak</button></form>@endif</div></div>
                @empty <p class="text-sm text-slate-500">Belum ada permintaan wawancara.</p> @endforelse
            </div>
        </div>
    </div>
</x-layouts.public>
