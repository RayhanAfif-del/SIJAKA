<x-layouts.admin title="Dashboard Admin">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Dashboard Admin</h1>
        <p class="text-sm text-gray-500">Selamat datang kembali, <span class="font-medium text-gray-700">{{ auth('admin')->user()->name }}</span>!</p>
    </div>

    {{-- Kartu statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <x-admin.stat-card label="Total Mitra" :value="$totalMitra" color="blue" />
        <x-admin.stat-card label="Total Lowongan" :value="$totalLowongan" color="green" />
        <x-admin.stat-card label="Total Artikel" :value="$totalArtikel" color="purple" />
        <x-admin.stat-card label="Total Alumni" :value="$totalAlumni" color="amber" />
    </div>

    {{-- Row: Statistik Alumni + Menunggu Persetujuan --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

        {{-- Statistik Penyerapan Alumni --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-medium text-gray-800">Statistik Penyerapan Alumni</h2>
                <a href="{{ route('admin.alumni.index') }}" class="text-xs text-blue-600 hover:underline">Kelola Alumni &rarr;</a>
            </div>

            @php $alumniTotalDashboard = $alumniBekerja + $alumniMelanjutkanStudi + $alumniBelumBekerja; @endphp

            @if ($alumniTotalDashboard > 0)
                <div class="flex flex-col sm:flex-row items-center gap-8">
                    <div class="w-44 h-44 shrink-0 relative">
                        <canvas id="chartAlumniDonut"></canvas>
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <span class="text-2xl font-bold text-gray-800">{{ $alumniTotalDashboard }}</span>
                            <span class="text-[11px] text-gray-400">Total Alumni</span>
                        </div>
                    </div>

                    <div class="w-full space-y-3">
                        <div class="flex items-center justify-between rounded-lg bg-blue-50 px-4 py-3">
                            <span class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="w-3 h-3 rounded-full bg-blue-600"></span> Bekerja
                            </span>
                            <span class="text-sm font-semibold text-gray-800">
                                {{ $alumniBekerja }}
                                <span class="text-gray-400 font-normal">({{ round($alumniBekerja / $alumniTotalDashboard * 100) }}%)</span>
                            </span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-amber-50 px-4 py-3">
                            <span class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="w-3 h-3 rounded-full bg-amber-500"></span> Melanjutkan Studi
                            </span>
                            <span class="text-sm font-semibold text-gray-800">
                                {{ $alumniMelanjutkanStudi }}
                                <span class="text-gray-400 font-normal">({{ round($alumniMelanjutkanStudi / $alumniTotalDashboard * 100) }}%)</span>
                            </span>
                        </div>
<div class="flex items-center justify-between rounded-lg bg-gray-100 px-4 py-3">
                            <span class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="w-3 h-3 rounded-full bg-gray-400"></span> Belum Bekerja
                            </span>
                            <span class="text-sm font-semibold text-gray-800">
                                {{ $alumniBelumBekerja }}
                                <span class="text-gray-400 font-normal">({{ round($alumniBelumBekerja / $alumniTotalDashboard * 100) }}%)</span>
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Bar chart penyerapan per tahun --}}
                @if ($alumniPerTahun->isNotEmpty())
                    <div class="mt-6 border-t border-gray-100 pt-5">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-sm font-medium text-gray-700">Penyerapan Alumni per Tahun</h3>
                        </div>
                        <div class="h-64">
                            <canvas id="chartAlumniPerTahun"></canvas>
                        </div>
                    </div>
                @endif
            @else
                <div class="flex flex-col items-center justify-center text-center py-10">
                    <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 1a3 3 0 10-3-3 3 3 0 003 3z"/></svg>
                    <p class="text-sm text-gray-400">Belum ada data alumni untuk ditampilkan.</p>
                </div>
            @endif
        </div>

        {{-- Lowongan Menunggu Persetujuan --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-medium text-gray-800">Menunggu Persetujuan</h2>
                <span class="text-xs bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full font-medium">{{ $lowonganMenunggu->count() }}</span>
            </div>

            <div class="space-y-3">
                @forelse ($lowonganMenunggu as $item)
                    <div class="flex items-center justify-between text-sm border-b border-gray-50 pb-3 last:border-0 last:pb-0">
                        <div class="min-w-0">
                            <p class="font-medium text-gray-800 truncate">{{ $item->posisi }}</p>
                            <p class="text-gray-400 text-xs truncate">{{ $item->mitra->nama_perusahaan }}</p>
                        </div>
                        <a href="{{ route('admin.lowongan.index', ['status' => 'menunggu']) }}" class="text-blue-600 text-xs hover:underline shrink-0 ml-2">Lihat</a>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center text-center py-8">
                        <svg class="w-10 h-10 text-gray-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-sm text-gray-400">Tidak ada lowongan menunggu.</p>
                    </div>
                @endforelse
            </div>

            @if ($lowonganMenunggu->isNotEmpty())
                <a href="{{ route('admin.lowongan.index', ['status' => 'menunggu']) }}" class="block text-center text-sm text-blue-600 mt-4 hover:underline">
                    Lihat semua &rarr;
                </a>
            @endif
        </div>
    </div>

    {{-- Row: Lowongan per Status + Top Dilihat --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        {{-- Lowongan Berdasarkan Status --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h2 class="font-medium text-gray-800 mb-4">Lowongan Berdasarkan Status</h2>

            @if ($lowonganByStatus->isNotEmpty())
                @php
                    $statusColors = ['disetujui' => '#16a34a', 'menunggu' => '#f59e0b', 'ditolak' => '#dc2626'];
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
                            <div class="flex items-center justify-between text-sm">
                                <span class="flex items-center gap-2 text-gray-600">
                                    <span class="w-3 h-3 rounded-full" style="background-color: {{ $statusColors[strtolower($status)] ?? '#9ca3af' }}"></span>
                                    {{ ucfirst($status) }}
                                </span>
                                <span class="font-semibold text-gray-800">{{ $jumlah }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="flex flex-col items-center justify-center text-center py-10">
                    <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                    <p class="text-sm text-gray-400">Belum ada data lowongan.</p>
                </div>
            @endif
        </div>

        {{-- Top Lowongan Dilihat --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h2 class="font-medium text-gray-800 mb-4">Top Lowongan Dilihat</h2>

            @if ($topLowongan->isNotEmpty())
                <div class="space-y-3">
                    @foreach ($topLowongan as $i => $item)
                        <div class="flex items-center justify-between text-sm {{ $loop->last ? '' : 'border-b border-gray-50 pb-3' }}">
                            <div class="flex items-center gap-3 min-w-0">
                                <span class="w-6 h-6 flex items-center justify-center rounded-full {{ $i < 3 ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-500' }} text-xs font-medium shrink-0">{{ $i + 1 }}</span>
                                <div class="min-w-0">
                                    <p class="font-medium text-gray-800 truncate">{{ $item->posisi }}</p>
                                    <p class="text-gray-400 text-xs truncate">{{ $item->mitra->nama_perusahaan }}</p>
                                </div>
                            </div>
                            <span class="flex items-center gap-1 text-gray-500 text-xs shrink-0 ml-2">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                {{ $item->jumlah_kunjungan }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center text-center py-10">
                    <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <p class="text-sm text-gray-400">Belum ada lowongan untuk ditampilkan.</p>
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
                // Donut Statistik Alumni
                const alumniEl = document.getElementById('chartAlumniDonut');
                const alumniTotal = {{ $alumniBekerja }} + {{ $alumniMelanjutkanStudi }} + {{ $alumniBelumBekerja }};
                if (alumniEl && alumniTotal > 0) {
                    new Chart(alumniEl, {
                        type: 'doughnut',
                        data: {
                            labels: ['Bekerja', 'Melanjutkan Studi', 'Belum Bekerja'],
                            datasets: [{
                                data: [{{ $alumniBekerja }}, {{ $alumniMelanjutkanStudi }}, {{ $alumniBelumBekerja }}],
                                backgroundColor: ['#2563eb', '#f59e0b', '#9ca3af'],
                                borderWidth: 3,
                                borderColor: '#ffffff',
                                hoverOffset: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '75%',
                            plugins: {
                                legend: { display: false },
                                tooltip: {
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

                // Bar chart penyerapan alumni per tahun
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
                                { label: 'Bekerja', data: tahunData.bekerja, backgroundColor: '#2563eb', borderRadius: 4, maxBarThickness: 28 },
                                { label: 'Melanjutkan Studi', data: tahunData.studi, backgroundColor: '#f59e0b', borderRadius: 4, maxBarThickness: 28 },
                                { label: 'Belum Bekerja', data: tahunData.belum, backgroundColor: '#9ca3af', borderRadius: 4, maxBarThickness: 28 },
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: { usePointStyle: true, boxWidth: 8, font: { size: 11 } }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (ctx) {
                                            const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                            const pct = total ? Math.round(ctx.raw / total * 100) : 0;
                                            return ' ' + ctx.dataset.label + ': ' + ctx.raw + ' (' + pct + '%)';
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: { grid: { display: false }, ticks: { font: { size: 11 } } },
                                y: { beginAtZero: true, ticks: { precision: 0, font: { size: 11 } }, grid: { color: '#f3f4f6' } }
                            }
                        }
                    });
                }
                @endif

                // Donut Lowongan Berdasarkan Status
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
                                borderWidth: 3,
                                borderColor: '#ffffff',
                                hoverOffset: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '70%',
                            plugins: {
                                legend: { display: false },
                                tooltip: {
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
