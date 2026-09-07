<x-layouts.admin title="Talenta Alumni">

    @php
        $statuses = ['Semua' => null, 'Menunggu' => 'menunggu', 'Disetujui' => 'disetujui', 'Ditolak' => 'ditolak'];
        $badge = [
            'menunggu'  => 'bg-amber-50 text-amber-700 border border-amber-200',
            'disetujui' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
            'ditolak'   => 'bg-red-50 text-red-700 border border-red-200',
        ];
    @endphp

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-700 transition flex items-center gap-1">
                    Dashboard
                </a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-700 font-medium">Talenta Alumni</span>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Talenta Alumni</h1>
            <p class="text-sm text-slate-500 mt-1">Tinjau pengajuan profil alumni sebelum ditampilkan kepada mitra perusahaan.</p>
        </div>
    </div>

    {{-- Filter Tabs --}}
    <div class="bg-white border border-slate-200/70 rounded-xl p-1.5 mb-5 flex flex-wrap gap-1 shadow-sm">
        @foreach ($statuses as $label => $value)
            @php
                $isActive = (request('status') === $value) || (is_null($value) && !request('status'));
            @endphp
            <a href="{{ is_null($value) ? route('admin.talent-pool.index') : route('admin.talent-pool.index', ['status' => $value]) }}" 
               class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $isActive ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- Data Table --}}
    <div class="bg-white border border-slate-200/70 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50/80 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Alumni</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Keahlian</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($talents as $item)
                        @php
                            // Handle keahlian yang mungkin berupa JSON string atau array
                            $skills = is_array($item->keahlian) ? $item->keahlian : json_decode($item->keahlian, true);
                            $skills = is_array($skills) ? $skills : [];
                            $displaySkills = array_slice($skills, 0, 3);
                            $remainingSkills = count($skills) - 3;
                            $status = $item->talent_approval_status ?? 'menunggu';
                        @endphp
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            {{-- Alumni Column --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-sm font-bold text-slate-600 shrink-0">
                                        {{ strtoupper(substr($item->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900 group-hover:text-blue-600 transition-colors">{{ $item->nama }}</p>
                                        <p class="text-xs text-slate-500 mt-0.5">
                                            {{ $item->headline ?: 'Headline belum diisi' }} 
                                            <span class="text-slate-300 mx-1">•</span> 
                                            {{ $item->jurusan ?? 'Jurusan -' }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Keahlian Column --}}
                            <td class="px-6 py-4">
                                @if(count($skills) > 0)
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach ($displaySkills as $skill)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-xs font-medium border border-slate-200">
                                                {{ $skill }}
                                            </span>
                                        @endforeach
                                        @if ($remainingSkills > 0)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-slate-50 text-slate-500 text-xs font-medium border border-slate-200">
                                                +{{ $remainingSkills }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-sm text-slate-400 italic">Belum diisi</span>
                                @endif
                            </td>

                            {{-- Status Column --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $badge[$status] }}">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current opacity-60"></span>
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            {{-- Aksi Column --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.talent-pool.show', $item) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-blue-700 bg-blue-50 border border-blue-200 hover:bg-blue-100 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Detail
                                    </a>
                                    @if ($status !== 'disetujui')
                                        <form method="POST" action="{{ route('admin.talent-pool.approve', $item) }}" onsubmit="return confirm('Setujui dan publikasikan talenta ini ke direktori publik?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 hover:bg-emerald-100 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                Setujui
                                            </button>
                                        </form>
                                    @endif

                                    @if ($status !== 'ditolak')
                                        <form method="POST" action="{{ route('admin.talent-pool.reject', $item) }}" onsubmit="return confirm('Tolak pengajuan talenta ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-red-700 bg-red-50 border border-red-200 hover:bg-red-100 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                Tolak
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    </div>
                                    <p class="text-sm font-semibold text-slate-700">Belum ada pengajuan talenta</p>
                                    <p class="text-xs text-slate-500 mt-1 max-w-xs">Data akan muncul di sini setelah alumni mengisi formulir profil talenta mereka.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($talents->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/50">
                {{ $talents->links() }}
            </div>
        @endif
    </div>

</x-layouts.admin>