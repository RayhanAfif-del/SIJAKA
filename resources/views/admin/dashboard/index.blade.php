<x-layouts.admin title="Dashboard Admin">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </p>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Dashboard Admin</h1>
            <p class="text-sm text-slate-500 mt-1">
                Selamat datang kembali, <span class="font-medium text-slate-700">{{ auth('admin')->user()->name }}</span> 👋
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.lowongan.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                Kelola Lowongan
            </a>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @php
            $stats = [
                ['label' => 'Total Mitra', 'value' => $totalMitra, 'color' => 'blue', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                ['label' => 'Total Lowongan', 'value' => $totalLowongan, 'color' => 'emerald', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                ['label' => 'Total Artikel', 'value' => $totalArtikel, 'color' => 'violet', 'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
                ['label' => 'Total Alumni', 'value' => $totalAlumni, 'color' => 'amber', 'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222'],
            ];
            $colorMap = [
                'blue'    => ['bg' => 'bg-blue-50',    'text' => 'text-blue-600',    'border' => 'border-blue-500'],
                'emerald' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-500'],
                'violet'  => ['bg' => 'bg-violet-50',  'text' => 'text-violet-600',  'border' => 'border-violet-500'],
                'amber'   => ['bg' => 'bg-amber-50',   'text' => 'text-amber-600',   'border' => 'border-amber-500'],
            ];
        @endphp

        @foreach ($stats as $stat)
            @php $c = $colorMap[$stat['color']]; @endphp
            <div class="group relative bg-white border border-slate-200/70 rounded-xl p-5 hover:shadow-md hover:border-slate-300 transition-all duration-200 overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1 {{ $c['border'] }}"></div>
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">{{ $stat['label'] }}</p>
                        <p class="text-3xl font-semibold text-slate-900 mt-2 tracking-tight">{{ number_format($stat['value']) }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-lg {{ $c['bg'] }} {{ $c['text'] }} flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"/>
                        </svg>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Main Row: Alumni Stats + Waiting Approval --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
        {{-- Alumni Stats --}}
        <div class="lg:col-span-2 bg-white border border-slate-200/70 rounded-xl p-5 sm:p-6 shadow-sm">
            <div class="flex items-center justify-between gap-3 mb-5">
                <div>
                    <h2 class="text-base font-semibold text-slate-900">Statistik Penyerapan Alumni</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Distribusi status alumni secara keseluruhan</p>
                </div>
                <a href="{{ route('admin.alumni.index') }}" class="inline-flex items-center gap-1 text-xs font-medium text-blue-600 hover:text-blue-700 transition">
                    Kelola
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>

            @php $alumniTotalDashboard = $alumniBekerja + $alumniMelanjutkanStudi + $alumniBelumBekerja; @endphp

            @if ($alumniTotalDashboard > 0)
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <div class="w-44 h-44 shrink-0 relative">
                        <canvas id="chartAlumniDonut"></canvas>
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <span class="text-3xl font-bold text-slate-900 tracking-tight">{{ number_format($alumniTotalDashboard) }}</span>
                            <span class="text-[11px] text-slate-400 font-medium uppercase tracking-wider">Total</span>
                        </div>
                    </div>

                    <div class="w-full space-y-2.5 flex-1">
                        @php
                            $alumniItems = [
                                ['label' => 'Bekerja', 'value' => $alumniBekerja, 'color' => 'blue', 'bg' => 'bg-blue-50'],
                                ['label' => 'Melanjutkan Studi', 'value' => $alumniMelanjutkanStudi, 'color' => 'amber', 'bg' => 'bg-amber-50'],
                                ['label' => 'Belum Bekerja', 'value' => $alumniBelumBekerja, 'color' => 'slate', 'bg' => 'bg-slate-100'],
                            ];
                            $dotColor = ['blue' => 'bg-blue-600', 'amber' => 'bg-amber-500', 'slate' => 'bg-slate-400'];
                        @endphp
                        @foreach ($alumniItems as $item)
                            @php $pct = $alumniTotalDashboard > 0 ? round($item['value'] / $alumniTotalDashboard * 100) : 0; @endphp
                            <div class="flex items-center justify-between rounded-lg {{ $item['bg'] }} px-4 py-3 transition hover:shadow-sm">
                                <span class="flex items-center gap-2.5 text-sm text-slate-700 font-medium">
                                    <span class="w-2.5 h-2.5 rounded-full {{ $dotColor[$item['color']] }}"></span>
                                    {{ $item['label'] }}
                                </span>
                                <div class="flex items-baseline gap-1.5">
                                    <span class="text-sm font-bold text-slate-900">{{ number_format($item['value']) }}</span>
                                    <span class="text-xs text-slate-500 font-medium">{{ $pct }}%</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if ($alumniPerTahun->isNotEmpty())
                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-sm font-semibold text-slate-800">Penyerapan Alumni per Tahun</h3>
                                <p class="text-xs text-slate-500 mt-0.5">Tren distribusi status alumni tiap tahun</p>
                            </div>
                        </div>
                        <div class="h-64">
                            <canvas id="chartAlumniPerTahun"></canvas>
                        </div>
                    </div>
                @endif
            @else
                <div class="flex flex-col items-center justify-center text-center py-12">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-slate-700">Belum ada data alumni</p>
                    <p class="text-xs text-slate-400 mt-1">Data akan muncul setelah alumni terdaftar</p>
                </div>
            @endif
        </div>

        {{-- Waiting Approval --}}
        <div class="bg-white border border-slate-200/70 rounded-xl p-5 sm:p-6 shadow-sm">
            <div class="flex items-center justify-between gap-3 mb-5">
                <div>
                    <h2 class="text-base font-semibold text-slate-900">Menunggu Persetujuan</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Lowongan yang perlu ditinjau</p>
                </div>
                @if ($lowonganMenunggu->count() > 0)
                    <span class="inline-flex items-center justify-center min-w-[24px] h-6 px-2 text-xs font-semibold bg-amber-100 text-amber-700 rounded-full">
                        {{ $lowonganMenunggu->count() }}
                    </span>
                @endif
            </div>

            <div class="space-y-1">
                @forelse ($lowonganMenunggu as $item)
                    <a href="{{ route('admin.lowongan.index', ['status' => 'menunggu']) }}" class="flex items-center justify-between gap-3 p-2.5 -mx-2.5 rounded-lg hover:bg-slate-50 transition group">
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-slate-800 truncate group-hover:text-blue-600 transition">{{ $item->posisi }}</p>
                            <p class="text-xs text-slate-500 truncate mt-0.5">{{ $item->mitra->nama_perusahaan }}</p>
                        </div>
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-blue-500 shrink-0 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @empty
                    <div class="flex flex-col items-center justify-center text-center py-10">
                        <div class="w-14 h-14 rounded-full bg-emerald-50 flex items-center justify-center mb-3">
                            <svg class="w-7 h-7 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-slate-700">Semua sudah ditinjau</p>
                        <p class="text-xs text-slate-400 mt-1">Tidak ada lowongan menunggu</p>
                    </div>
                @endforelse
            </div>

            @if ($lowonganMenunggu->isNotEmpty())
                <a href="{{ route('admin.lowongan.index', ['status' => 'menunggu']) }}" class="flex items-center justify-center gap-1.5 w-full mt-4 pt-4 border-t border-slate-100 text-sm font-medium text-blue-600 hover:text-blue-700 transition">
                    Lihat semua
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>

    {{-- Bottom Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        {{-- Lowongan by Status --}}
        <div class="bg-white border border-slate-200/70 rounded-xl p-5 sm:p-6 shadow-sm">
            <div class="mb-5">
                <h2 class="text-base font-semibold text-slate-900">Lowongan Berdasarkan Status</h2>
                <p class="text-xs text-slate-500 mt-0.5">Distribusi status persetujuan lowongan</p>
            </div>

            @if ($lowonganByStatus->isNotEmpty())
                @php
                    $statusColors = ['disetujui' => '#10b981', 'menunggu' => '#f59e0b', 'ditolak' => '#ef4444'];
                    $labelsStatus = array_map('ucfirst', array_keys($lowonganByStatus->toArray()));
                    $valuesStatus = array_values($lowonganByStatus->toArray());
                    $colorsStatus = array_map(fn ($s) => $statusColors[strtolower($s)] ?? '#9ca3af', array_keys($lowonganByStatus->toArray()));
                @endphp
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <div class="w-40 h-40 shrink-0">
                        <canvas id="chartStatusDonut"></canvas>
                    </div>
                    <div class="w-full space-y-2">
                        @foreach ($lowonganByStatus as $status => $jumlah)
                            @php
                                $hex = $statusColors[strtolower($status)] ?? '#9ca3af';
                                $softBg = match(strtolower($status)) {
                                    'disetujui' => 'bg-emerald-50',
                                    'menunggu'  => 'bg-amber-50',
                                    'ditolak'   => 'bg-red-50',
                                    default     => 'bg-slate-100',
                                };
                            @endphp
                            <div class="flex items-center justify-between text-sm rounded-lg {{ $softBg }} px-3.5 py-2.5">
                                <span class="flex items-center gap-2 text-slate-700 font-medium">
                                    <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $hex }}"></span>
                                    {{ ucfirst($status) }}
                                </span>
                                <span class="font-bold text-slate-900">{{ $jumlah }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="flex flex-col items-center justify-center text-center py-12">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-slate-700">Belum ada data lowongan</p>
                    <p class="text-xs text-slate-400 mt-1">Data akan muncul setelah lowongan dibuat</p>
                </div>
            @endif
        </div>

        {{-- Top Lowongan --}}
        <div class="bg-white border border-slate-200/70 rounded-xl p-5 sm:p-6 shadow-sm">
            <div class="mb-5">
                <h2 class="text-base font-semibold text-slate-900">Top Lowongan Dilihat</h2>
                <p class="text-xs text-slate-500 mt-0.5">Lowongan dengan kunjungan terbanyak</p>
            </div>

            @if ($topLowongan->isNotEmpty())
                <div class="space-y-1">
                    @foreach ($topLowongan as $i => $item)
                        <div class="flex items-center justify-between gap-3 p-2.5 -mx-2.5 rounded-lg hover:bg-slate-50 transition">
                            <div class="flex items-center gap-3 min-w-0 flex-1">
                                <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold shrink-0
                                    {{ $i === 0 ? 'bg-gradient-to-br from-amber-400 to-amber-500 text-white shadow-sm' :
                                       ($i === 1 ? 'bg-gradient-to-br from-slate-300 to-slate-400 text-white shadow-sm' :
                                       ($i === 2 ? 'bg-gradient-to-br from-orange-300 to-orange-400 text-white shadow-sm' :
                                       'bg-slate-100 text-slate-600')) }}">
                                    {{ $i + 1 }}
                                </span>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-medium text-slate-800 truncate">{{ $item->posisi }}</p>
                                    <p class="text-xs text-slate-500 truncate mt-0.5">{{ $item->mitra->nama_perusahaan }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 text-slate-600 text-xs font-semibold shrink-0 bg-slate-100 px-2 py-1 rounded-md">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                {{ number_format($item->jumlah_kunjungan) }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center text-center py-12">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-slate-700">Belum ada kunjungan</p>
                    <p class="text-xs text-slate-400 mt-1">Data akan muncul setelah ada kunjungan</p>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        @php
            $tahunLabelsData = $alumniPerTahun->keys()->map(fn ($t) => (string) $t)->values();
            $tahunBekerjaData = $alumniPerTahun->map(fn ($g) => $g->where('status', 'Bekerja')->sum('total'))->values();
            $tahunStudiData = $alumniPerTahun->map(fn ($g) => $g->where('status', 'Melanjutkan Studi')->sum('total'))->values();
            $tahunBelumData = $alumniPerTahun->map(fn ($g) => $g->where('status', 'Belum Bekerja')->sum('total'))->values();
        @endphp
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Default Chart.js styling
                Chart.defaults.font.family = "'Inter', system-ui, -apple-system, sans-serif";
                Chart.defaults.color = '#64748b';

                const alumniEl = document.getElementById('chartAlumniDonut');
                const alumniTotal = {{ $alumniBekerja }} + {{ $alumniMelanjutkanStudi }} + {{ $alumniBelumBekerja }};
                if (alumniEl && alumniTotal > 0) {
                    new Chart(alumniEl, {
                        type: 'doughnut',
                        data: {
                            labels: ['Bekerja', 'Melanjutkan Studi', 'Belum Bekerja'],
                            datasets: [{
                                data: [{{ $alumniBekerja }}, {{ $alumniMelanjutkanStudi }}, {{ $alumniBelumBekerja }}],
                                backgroundColor: ['#2563eb', '#f59e0b', '#cbd5e1'],
                                borderWidth: 0,
                                hoverOffset: 8,
                                spacing: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '78%',
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: '#0f172a',
                                    padding: 10,
                                    cornerRadius: 8,
                                    titleFont: { size: 12, weight: '600' },
                                    bodyFont: { size: 12 },
                                    displayColors: true,
                                    boxPadding: 4,
                                    callbacks: {
                                        label: function (ctx) {
                                            const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                            const pct = total ? Math.round(ctx.raw / total * 100) : 0;
                                            return ' ' + ctx.label + ': ' + ctx.raw + ' (' + pct + '%)';
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

                const perTahunEl = document.getElementById('chartAlumniPerTahun');
                @if ($alumniPerTahun->isNotEmpty())
                if (perTahunEl) {
                    const tahunData = {
                        labels: {!! json_encode($tahunLabelsData) !!},
                        bekerja: {!! json_encode($tahunBekerjaData) !!},
                        studi: {!! json_encode($tahunStudiData) !!},
                        belum: {!! json_encode($tahunBelumData) !!}
                    };
                    new Chart(perTahunEl, {
                        type: 'bar',
                        data: {
                            labels: tahunData.labels,
                            datasets: [
                                { label: 'Bekerja', data: tahunData.bekerja, backgroundColor: '#2563eb', borderRadius: 6, borderSkipped: false, maxBarThickness: 28 },
                                { label: 'Melanjutkan Studi', data: tahunData.studi, backgroundColor: '#f59e0b', borderRadius: 6, borderSkipped: false, maxBarThickness: 28 },
                                { label: 'Belum Bekerja', data: tahunData.belum, backgroundColor: '#cbd5e1', borderRadius: 6, borderSkipped: false, maxBarThickness: 28 },
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: { usePointStyle: true, pointStyle: 'circle', boxWidth: 6, padding: 16, font: { size: 11, weight: '500' } }
                                },
                                tooltip: {
                                    backgroundColor: '#0f172a',
                                    padding: 10,
                                    cornerRadius: 8,
                                    titleFont: { size: 12, weight: '600' },
                                    bodyFont: { size: 12 },
                                    boxPadding: 4
                                }
                            },
                            scales: {
                                x: { grid: { display: false }, ticks: { font: { size: 11, weight: '500' } }, border: { display: false } },
                                y: { beginAtZero: true, ticks: { precision: 0, font: { size: 11 }, padding: 8 }, grid: { color: '#f1f5f9', drawBorder: false }, border: { display: false } }
                            }
                        }
                    });
                }
                @endif

                const statusEl = document.getElementById('chartStatusDonut');
                @if ($lowonganByStatus->isNotEmpty())
                if (statusEl) {
                    new Chart(statusEl, {
                        type: 'doughnut',
                        data: {
                            labels: {!! json_encode($labelsStatus) !!},
                            datasets: [{
                                data: {!! json_encode($valuesStatus) !!},
                                backgroundColor: {!! json_encode($colorsStatus) !!},
                                borderWidth: 0,
                                hoverOffset: 8,
                                spacing: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '75%',
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: '#0f172a',
                                    padding: 10,
                                    cornerRadius: 8,
                                    titleFont: { size: 12, weight: '600' },
                                    bodyFont: { size: 12 },
                                    displayColors: true,
                                    boxPadding: 4,
                                    callbacks: {
                                        label: function (ctx) {
                                            const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                            const pct = total ? Math.round(ctx.raw / total * 100) : 0;
                                            return ' ' + ctx.label + ': ' + ctx.raw + ' (' + pct + '%)';
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
                @endif
            });
        </script>
    @endpush

</x-layouts.admin>