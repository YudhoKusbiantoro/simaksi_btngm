<x-admin-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-green-900">Laporan SIMAKSI</h2>
        <p class="text-gray-500">Rekap data pengajuan berdasarkan periode dan jenis kegiatan</p>
    </div>

    <!-- Rekap Stats Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Total Pengajuan -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 border-l-4 border-l-blue-500">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Pengajuan</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $rekapStatus['total'] }}</h3>
                </div>
            </div>
        </div>

        <!-- Citizenship Comparison (Span 2) -->
        <div class="lg:col-span-2 bg-gradient-to-br from-green-800 to-green-900 p-6 rounded-2xl shadow-lg text-white">
            <h4 class="text-xs font-bold uppercase tracking-widest mb-4 opacity-70">Kewarganegaraan</h4>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/10 p-4 rounded-xl backdrop-blur-sm border border-white/10">
                    <p class="text-3xl font-black">{{ $rekapKewarganegaraan['wni'] }}</p>
                    <p class="text-[10px] font-bold uppercase text-green-300">Warga Negara Indonesia</p>
                </div>

                <div class="bg-white/10 p-4 rounded-xl backdrop-blur-sm border border-white/10">
                    <p class="text-3xl font-black">{{ $rekapKewarganegaraan['wna'] }}</p>
                    <p class="text-[10px] font-bold uppercase text-green-300">Warga Negara Asing</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <form action="{{ route('admin.laporan.index') }}" method="GET"
        class="flex flex-wrap items-end gap-3 bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-8">
        <div>
            <label for="month" class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Bulan</label>
            <select name="month" id="month"
                class="text-sm border-gray-200 rounded-lg focus:ring-green-500 focus:border-green-500 min-w-[120px]">
                <option value="">Semua Bulan</option>
                @foreach($months as $num => $name)
                    <option value="{{ $num }}" {{ $selectedMonth == $num ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="year" class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Tahun</label>
            <select name="year" id="year"
                class="text-sm border-gray-200 rounded-lg focus:ring-green-500 focus:border-green-500 min-w-[100px]">
                <option value="all" {{ $selectedYear == 'all' ? 'selected' : '' }}>Semua Tahun</option>
                @foreach($years as $year)
                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end gap-2 border-l pl-3 border-gray-100">
            <div>
                <label for="start_year" class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Dari</label>
                <select name="start_year" id="start_year"
                    class="text-sm border-gray-200 rounded-lg focus:ring-green-500 focus:border-green-500 min-w-[90px]">
                    <option value="">-</option>
                    @foreach(array_reverse($years) as $year)
                        <option value="{{ $year }}" {{ $startYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="end_year" class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Sampai</label>
                <select name="end_year" id="end_year"
                    class="text-sm border-gray-200 rounded-lg focus:ring-green-500 focus:border-green-500 min-w-[90px]">
                    <option value="">-</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ $endYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label for="jenis_kegiatan_id" class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Jenis
                Kegiatan</label>
            <select name="jenis_kegiatan_id" id="jenis_kegiatan_id"
                class="text-sm border-gray-200 rounded-lg focus:ring-green-500 focus:border-green-500 min-w-[150px]">
                <option value="">Semua Jenis</option>
                @foreach($jenisKegiatan as $jenis)
                    <option value="{{ $jenis->id }}" {{ $selectedJenisKegiatan == $jenis->id ? 'selected' : '' }}>
                        {{ $jenis->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit"
            class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg text-sm font-bold transition shadow-sm">
            Filter
        </button>
        <a href="{{ route('admin.laporan.index') }}" class="text-gray-400 hover:text-gray-600 p-2 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
        </a>
    </form>


    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50">
                <h3 class="font-bold text-gray-800">Distribusi Jenis Kegiatan</h3>
                <p class="text-xs text-gray-500 mt-1">
                    {{ isset($months[(string) $selectedMonth]) ? $months[(string) $selectedMonth] : 'Semua Bulan' }}
                    @if($startYear && $endYear)
                        {{ $startYear }} - {{ $endYear }}
                    @elseif($selectedYear == 'all')
                        Semua Tahun
                    @else
                        {{ $selectedYear }}
                    @endif
                </p>
            </div>
            <div class="p-6">
                <div class="relative min-h-[300px] flex items-center justify-center">
                    @if($rekapStatus['total'] > 0)
                        <canvas id="overallChart"></canvas>
                    @else
                        <div class="text-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2 opacity-20" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                            <p class="text-sm italic">Tidak ada data untuk periode ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Bar Chart Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50">
                <h3 class="font-bold text-gray-800">Grafik Batang Jenis Kegiatan</h3>
                <p class="text-xs text-gray-500 mt-1">
                    {{ isset($months[(string) $selectedMonth]) ? $months[(string) $selectedMonth] : 'Semua Bulan' }}
                    @if($startYear && $endYear)
                        {{ $startYear }} - {{ $endYear }}
                    @elseif($selectedYear == 'all')
                        Semua Tahun
                    @else
                        {{ $selectedYear }}
                    @endif
                </p>
            </div>
            <div class="p-6">
                <div class="relative min-h-[300px] flex items-center justify-center">
                    @if($rekapStatus['total'] > 0)
                        <canvas id="periodChart"></canvas>
                    @else
                        <div class="text-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2 opacity-20" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <p class="text-sm italic">Tidak ada data untuk periode ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Analytics Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Monthly Trend Chart -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50">
                <h3 class="font-bold text-gray-800">Tren Pengajuan Bulanan</h3>
                <p class="text-xs text-gray-500 mt-1">Pengajuan per bulan
                    @if($startYear && $endYear)
                        ({{ $startYear }} - {{ $endYear }})
                    @elseif($selectedYear == 'all')
                        (Semua Tahun)
                    @else
                        di tahun {{ $selectedYear }}
                    @endif
                </p>
            </div>
            <div class="p-6">
                <div class="relative min-h-[350px] flex items-center justify-center">
                    <canvas id="monthlyTrendChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Yearly Comparison Chart -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50">
                <h3 class="font-bold text-gray-800">Perbandingan Tahunan</h3>
                <p class="text-xs text-gray-500 mt-1">Total pengajuan per tahun</p>
            </div>
            <div class="p-6">
                <div class="relative min-h-[350px] flex items-center justify-center">
                    <canvas id="yearlyComparisonChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Report -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
        <div class="p-6 border-b border-gray-50 flex items-center justify-between">
            <h3 class="font-bold text-gray-800">Detail Laporan Jenis Kegiatan</h3>
            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                {{ isset($months[(string) $selectedMonth]) ? $months[(string) $selectedMonth] : 'Semua Bulan' }}
                @if($startYear && $endYear)
                    {{ $startYear }} - {{ $endYear }}
                @elseif($selectedYear == 'all')
                    Semua Tahun
                @else
                    {{ $selectedYear }}
                @endif
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th
                            class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                            Jenis Kegiatan</th>
                        <th
                            class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100 text-center">
                            Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($laporanJenis as $laporan)
                        <tr class="hover:bg-gray-50/50 transition duration-150 cursor-pointer group"
                            onclick="showDetail({{ $laporan['id'] }}, '{{ $laporan['nama'] }}')">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full"
                                        style="background-color: var(--chart-color-{{ $loop->index }})"></div>
                                    <span
                                        class="font-bold text-gray-700 text-sm group-hover:text-green-700">{{ $laporan['nama'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-50 text-green-700">
                                    {{ $laporan['total'] }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-20 text-center">
                                <div class="text-gray-400 italic flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2 opacity-20" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p>Data tidak ditemukan untuk periode ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="closeModal()"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full border border-gray-100">
                <div class="bg-white px-8 py-6 border-b border-gray-50 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-black text-green-900" id="modal-title">
                            Detail Pengajuan
                        </h3>
                        <p class="text-xs text-gray-500 mt-1" id="modal-subtitle"></p>
                    </div>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="bg-white px-8 py-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-3 text-[10px] font-bold text-gray-500 uppercase tracking-wider">
                                        Pemohon</th>
                                    <th class="px-4 py-3 text-[10px] font-bold text-gray-500 uppercase tracking-wider">
                                        Instansi</th>
                                    <th class="px-4 py-3 text-[10px] font-bold text-gray-500 uppercase tracking-wider">
                                        Periode</th>
                                    <th
                                        class="px-4 py-3 text-[10px] font-bold text-gray-500 uppercase tracking-wider text-center">
                                        Status</th>
                                    <th class="px-4 py-3"></th>
                                </tr>
                            </thead>
                            <tbody id="modal-content-body" class="divide-y divide-gray-50">
                                <!-- Ajax Content -->
                            </tbody>
                        </table>
                    </div>
                    <div id="modal-loader" class="py-12 text-center hidden">
                        <div
                            class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-green-700 border-t-transparent">
                        </div>
                        <p class="mt-2 text-sm text-gray-500 font-medium">Memuat data...</p>
                    </div>
                </div>
                <div class="bg-gray-50 px-8 py-4 text-right">
                    <button type="button" onclick="closeModal()"
                        class="px-6 py-2 bg-white border border-gray-200 rounded-xl text-sm font-bold text-gray-700 hover:bg-gray-50 transition shadow-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Register datalabels plugin globally or for specific chart
            Chart.register(ChartDataLabels);

            const colors = [
                '#15803d', // Green-700
                '#16a34a', // Green-600
                '#22c55e', // Green-500
                '#4ade80', // Green-400
                '#86efac', // Green-300
                '#bbf7d0', // Green-200
            ];

            // Set CSS variables for table legends
            colors.forEach((color, i) => {
                document.documentElement.style.setProperty(`--chart-color-${i}`, color);
            });

            // Overall Pie Chart
            const ctxOverall = document.getElementById('overallChart');
            new Chart(ctxOverall, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($laporanJenis->pluck('nama')) !!},
                    datasets: [{
                        data: {!! json_encode($laporanJenis->pluck('total')) !!},
                        backgroundColor: colors,
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    layout: {
                        padding: 40
                    },
                    plugins: {
                        legend: {
                            display: false // Hide legend as requested
                        },
                        datalabels: {
                            color: '#fff',
                            anchor: 'center',
                            align: 'center',
                            offset: 0,
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            formatter: (value, ctx) => {
                                if (value === 0) return null;
                                let label = ctx.chart.data.labels[ctx.dataIndex];
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => { sum += data; });
                                let percentage = (value * 100 / sum).toFixed(0) + '%';
                                return label + '\n' + percentage;
                            },
                            textAlign: 'center',
                            display: 'auto'
                        }
                    },
                    maintainAspectRatio: false,
                    responsive: true
                }
            });

            // Period Bar Chart
            @if($rekapStatus['total'] > 0)
                const ctxPeriod = document.getElementById('periodChart');
                new Chart(ctxPeriod, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($chartLabels) !!},
                        datasets: [{
                            label: 'Jumlah Pengajuan',
                            data: {!! json_encode($chartData) !!},
                            backgroundColor: colors,
                            borderRadius: 8,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        size: 10,
                                        weight: 'bold'
                                    }
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    font: {
                                        size: 10
                                    },
                                    stepSize: 1
                                }
                            }
                        },
                        maintainAspectRatio: false,
                        responsive: true
                    }
                });
            @endif

            const ctxMonthlyTrend = document.getElementById('monthlyTrendChart');
            new Chart(ctxMonthlyTrend, {
                type: 'line',
                data: {
                    labels: {!! json_encode($monthlyTrendLabels) !!},
                    datasets: [{
                        label: 'Jumlah Pengajuan',
                        data: {!! json_encode($monthlyTrendData) !!},
                        borderColor: '#15803d',
                        backgroundColor: 'rgba(21, 128, 61, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#15803d',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 10,
                                    weight: 'bold'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                font: {
                                    size: 10
                                },
                                stepSize: 1
                            }
                        }
                    },
                    maintainAspectRatio: false,
                    responsive: true
                }
            });

            // Yearly Comparison Bar Chart
            const ctxYearlyComparison = document.getElementById('yearlyComparisonChart');
            new Chart(ctxYearlyComparison, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($yearlyComparisonLabels) !!},
                    datasets: [{
                        label: 'Total Pengajuan',
                        data: {!! json_encode($yearlyComparisonData) !!},
                        backgroundColor: [
                            '#15803d',
                            '#16a34a',
                            '#22c55e',
                            '#4ade80',
                            '#86efac'
                        ],
                        borderRadius: 8,
                        borderSkipped: false
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11,
                                    weight: 'bold'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                font: {
                                    size: 10
                                },
                                stepSize: 1
                            }
                        }
                    },
                    maintainAspectRatio: false,
                    responsive: true
                }
            });
            // Modal Logic
            const modal = document.getElementById('detailModal');
            const modalTitle = document.getElementById('modal-title');
            const modalSubtitle = document.getElementById('modal-subtitle');
            const modalContent = document.getElementById('modal-content-body');
            const modalLoader = document.getElementById('modal-loader');

            window.showDetail = function (jenisId, jenisNama) {
                modal.classList.remove('hidden');
                modalTitle.innerText = jenisNama;
                modalSubtitle.innerText = 'Daftar pengaju untuk periode ini';
                modalContent.innerHTML = '';
                modalLoader.classList.remove('hidden');

                const month = document.getElementById('month').value;
                const year = document.getElementById('year').value;
                const startYear = document.getElementById('start_year').value;
                const endYear = document.getElementById('end_year').value;

                fetch(`{{ route('admin.laporan.detail') }}?jenis_kegiatan_id=${jenisId}&month=${month}&year=${year}&start_year=${startYear}&end_year=${endYear}`)
                    .then(response => response.json())
                    .then(data => {
                        modalLoader.classList.add('hidden');
                        if (data.length === 0) {
                            modalContent.innerHTML = `<tr><td colspan="5" class="py-8 text-center text-gray-400 italic text-sm">Tidak ada data ditemukan</td></tr>`;
                            return;
                        }

                        data.forEach(item => {
                            let statusClass = '';
                            switch (item.status) {
                                case 'approved': statusClass = 'bg-green-100 text-green-700'; break;
                                case 'pending': statusClass = 'bg-yellow-100 text-yellow-700'; break;
                                case 'rejected': statusClass = 'bg-red-100 text-red-700'; break;
                                default: statusClass = 'bg-gray-100 text-gray-700';
                            }

                            modalContent.innerHTML += `
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-4 text-sm font-bold text-gray-800">${item.nama_pemohon}</td>
                                    <td class="px-4 py-4 text-xs text-gray-500">${item.instansi || '-'}</td>
                                    <td class="px-4 py-4 text-xs text-gray-500">${item.tanggal_mulai} - ${item.tanggal_selesai}</td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-black uppercase ${statusClass}">
                                            ${item.status}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-right">
                                        <a href="${item.url}" class="text-green-600 hover:text-green-800 font-bold text-xs uppercase tracking-widest">Detail →</a>
                                    </td>
                                </tr>
                            `;
                        });
                    });
            };

            window.closeModal = function () {
                modal.classList.add('hidden');
            };
        });
    </script>
</x-admin-layout>