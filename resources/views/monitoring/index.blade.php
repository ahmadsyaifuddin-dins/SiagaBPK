<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100 leading-tight flex items-center">
                <div class="bg-gradient-to-br from-red-500 to-orange-500 text-white p-2.5 rounded-xl mr-3 shadow-md">
                    <i class="fa-solid fa-chart-line text-xl w-6 h-6 flex items-center justify-center"></i>
                </div>
                {{ __('Monitoring BPK Kota Banjarmasin') }}
            </h2>

            <div
                class="flex items-center space-x-2 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md px-4 py-2.5 rounded-xl shadow-sm border border-gray-200/50 dark:border-gray-700/50">
                <i class="fa-solid fa-city text-cyan-500"></i>
                <span>Ruang Lingkup: 5 Kecamatan Kota Banjarmasin</span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 min-h-screen space-y-6">

        @include('monitoring.partials.filter')
        @include('monitoring.partials.stats')
        @include('monitoring.partials.charts')
        @include('monitoring.partials.rekap-kecamatan')
        @include('monitoring.partials.recent-incidents')

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <script>
        function tampilkanFallbackGrafik() {
            document.querySelectorAll('[data-chart-fallback]').forEach(function(el) {
                el.parentElement.innerHTML = '<div class="h-full flex flex-col items-center justify-center text-center">' +
                    '<i class="fa-solid fa-chart-simple text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>' +
                    '<p class="text-sm text-gray-500 dark:text-gray-400">Grafik tidak dapat dimuat.<br>Periksa koneksi internet lalu muat ulang halaman.</p></div>';
            });
        }

        function initGrafikMonitoring() {
            if (typeof Chart === 'undefined') return false;
            if (window.__grafikMonitoringSudah) return true;

            const canvasBulanan = document.getElementById('chartBulanan');
            const canvasKecamatan = document.getElementById('chartKecamatan');
            const canvasJenis = document.getElementById('chartJenis');
            if (!canvasBulanan || !canvasKecamatan) return false;

            window.__grafikMonitoringSudah = true;

            const fontDark = document.documentElement.classList.contains('dark');
            const warnaTeks = fontDark ? '#d1d5db' : '#4b5563';
            const warnaGrid = fontDark ? 'rgba(75, 85, 99, 0.35)' : 'rgba(209, 213, 219, 0.6)';

            Chart.defaults.color = warnaTeks;
            Chart.defaults.font.family = 'Figtree, sans-serif';

            const opsiDasar = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 16
                        }
                    }
                }
            };

            // ===== 1. TREN BULANAN =====
            new Chart(canvasBulanan, {
                type: 'bar',
                data: {
                    labels: @js($chartBulanLabels),
                    datasets: [{
                            label: 'Jumlah Insiden',
                            data: @js($chartBulanInsiden),
                            backgroundColor: 'rgba(239, 68, 68, 0.7)',
                            borderColor: 'rgba(239, 68, 68, 1)',
                            borderWidth: 1,
                            borderRadius: 6,
                            yAxisID: 'y'
                        },
                        {
                            label: 'Korban Jiwa',
                            data: @js($chartBulanKorban),
                            type: 'line',
                            borderColor: 'rgba(168, 85, 247, 1)',
                            backgroundColor: 'rgba(168, 85, 247, 0.15)',
                            tension: 0.35,
                            fill: true,
                            pointRadius: 4,
                            yAxisID: 'y'
                        }
                    ]
                },
                options: { ...opsiDasar,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            },
                            grid: {
                                color: warnaGrid
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // ===== 2. INSIDEN PER KECAMATAN =====
            new Chart(canvasKecamatan, {
                type: 'bar',
                data: {
                    labels: @js($chartKecamatanLabels),
                    datasets: [{
                        label: 'Jumlah Insiden',
                        data: @js($chartKecamatanInsiden),
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.75)',
                            'rgba(16, 185, 129, 0.75)',
                            'rgba(245, 158, 11, 0.75)',
                            'rgba(239, 68, 68, 0.75)',
                            'rgba(139, 92, 246, 0.75)'
                        ],
                        borderRadius: 8
                    }]
                },
                options: { ...opsiDasar,
                    indexAxis: 'y',
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            },
                            grid: {
                                color: warnaGrid
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // ===== 3. DISTRIBUSI JENIS INSIDEN =====
            if (canvasJenis) {
                const palet = ['#ef4444', '#f97316', '#eab308', '#22c55e', '#3b82f6', '#8b5cf6', '#ec4899', '#14b8a6'];
                new Chart(canvasJenis, {
                    type: 'doughnut',
                    data: {
                        labels: @js($chartJenisLabels),
                        datasets: [{
                            data: @js($chartJenisValues),
                            backgroundColor: palet,
                            borderWidth: 2,
                            borderColor: fontDark ? '#1f2937' : '#ffffff'
                        }]
                    },
                    options: { ...opsiDasar,
                        cutout: '58%'
                    }
                });
            }

            return true;
        }

        function mulaiGrafikMonitoring() {
            // Beri waktu CDN hingga ±6 detik, lalu tampilkan pesan fallback
            let percobaan = 0;
            const timer = setInterval(function() {
                percobaan++;
                if (initGrafikMonitoring() || percobaan >= 24) {
                    clearInterval(timer);
                    if (!initGrafikMonitoring()) {
                        console.warn('Chart.js (CDN) gagal dimuat - grafik monitoring tidak ditampilkan.');
                        tampilkanFallbackGrafik();
                    }
                }
            }, 250);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', mulaiGrafikMonitoring);
        } else {
            mulaiGrafikMonitoring();
        }
    </script>
</x-app-layout>
