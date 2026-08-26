<x-layouts.mitra title="Dashboard Mitra">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </p>
            <h1 class="text-2xl font-semibold text-slate-900 tracking-tight">Dashboard Mitra</h1>
            <p class="text-sm text-slate-500 mt-1">
                Selamat datang kembali, <span class="font-medium text-slate-700">{{ auth('mitra')->user()->nama_perusahaan }}</span> 👋
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('mitra.lowongan.create') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Buat Lowongan
            </a>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <x-admin.stat-card label="Total Lowongan" :value="$totalLowongan" color="blue" />
        <x-admin.stat-card label="Menunggu Persetujuan" :value="$menunggu" color="amber" />
        <x-admin.stat-card label="Disetujui" :value="$disetujui" color="green" />
        <x-admin.stat-card label="Ditolak" :value="$ditolak" color="purple" />
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">

        {{-- Chart Panel --}}
        <div class="lg:col-span-2 bg-white border border-slate-200/70 rounded-xl p-5 sm:p-6 shadow-sm">
            <div class="flex items-center justify-between gap-3 mb-5">
                <div>
                    <h2 class="text-base font-semibold text-slate-900">Grafik Lowongan Saya</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Tren pembuatan lowongan dalam 7 hari terakhir</p>
                </div>
            </div>
            <div class="h-64">
                <canvas id="chartLowongan"></canvas>
            </div>
        </div>

        {{-- Recent Jobs Panel --}}
        <div class="bg-white border border-slate-200/70 rounded-xl p-5 sm:p-6 shadow-sm">
            <div class="flex items-center justify-between gap-3 mb-5">
                <div>
                    <h2 class="text-base font-semibold text-slate-900">Lowongan Terbaru</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Daftar lowongan yang baru saja dibuat</p>
                </div>
                <a href="{{ route('mitra.lowongan.index') }}" class="inline-flex items-center gap-1 text-xs font-medium text-blue-600 hover:text-blue-700 transition">
                    Lihat Semua
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>

            <div class="space-y-1">
                @forelse ($lowonganTerbaru as $item)
                    @php
                        $statusConfig = [
                            'disetujui' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'dot' => 'bg-emerald-500'],
                            'ditolak'   => ['bg' => 'bg-red-50', 'text' => 'text-red-700', 'border' => 'border-red-200', 'dot' => 'bg-red-500'],
                            'menunggu'  => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-200', 'dot' => 'bg-amber-500'],
                        ];
                        $sc = $statusConfig[$item->status] ?? $statusConfig['menunggu'];
                    @endphp
                    
                    <a href="{{ route('mitra.lowongan.edit', $item) }}" class="flex items-center justify-between gap-3 p-2.5 -mx-2.5 rounded-lg hover:bg-slate-50 transition group">
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-slate-800 truncate group-hover:text-blue-600 transition">{{ $item->posisi }}</p>
                            <p class="text-xs text-slate-500 mt-0.5 flex items-center gap-1">
                                <svg class="w-3 h-3 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $item->created_at->translatedFormat('d M Y') }}
                            </p>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $sc['bg'] }} {{ $sc['text'] }} border {{ $sc['border'] }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $sc['dot'] }}"></span>
                            {{ ucfirst($item->status) }}
                        </span>
                    </a>
                @empty
                    <div class="flex flex-col items-center justify-center text-center py-8">
                        <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-slate-700">Belum ada lowongan</p>
                        <p class="text-xs text-slate-400 mt-1">Mulai buat lowongan pertama Anda</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- CTA Box --}}
    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-100 rounded-xl p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-slate-900">Perlu bantuan?</p>
                <p class="text-sm text-slate-600 mt-0.5">Hubungi tim BKK SMK N 1 Bangsri jika memerlukan bantuan terkait pengelolaan lowongan atau akun mitra.</p>
            </div>
        </div>
        <a href="{{ route('kontak.index') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 text-sm font-medium text-blue-700 bg-white border border-blue-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition shrink-0 shadow-sm">
            Hubungi BKK
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </a>
    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Modern Chart.js Defaults
            Chart.defaults.font.family = "'Figtree', system-ui, -apple-system, sans-serif";
            Chart.defaults.color = '#64748b';
            
            const ctx = document.getElementById('chartLowongan');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($grafik->keys()) !!},
                        datasets: [{
                            label: 'Lowongan Dibuat',
                            data: {!! json_encode($grafik->values()) !!},
                            borderColor: '#2563eb',
                            backgroundColor: 'rgba(37, 99, 235, 0.08)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#2563eb',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#0f172a',
                                padding: 10,
                                cornerRadius: 8,
                                titleFont: { size: 12, weight: '600' },
                                bodyFont: { size: 12 },
                                displayColors: false,
                                callbacks: {
                                    label: function(context) {
                                        return ' ' + context.raw + ' Lowongan';
                                    }
                                }
                            }
                        },
                        scales: {
                            x: { 
                                grid: { display: false }, 
                                ticks: { font: { size: 11 } },
                                border: { display: false }
                            },
                            y: { 
                                beginAtZero: true, 
                                ticks: { stepSize: 1, font: { size: 11 }, padding: 8 }, 
                                grid: { color: '#f1f5f9', drawBorder: false },
                                border: { display: false }
                            }
                        }
                    }
                });
            }
        });
    </script>
    @endpush

</x-layouts.mitra>