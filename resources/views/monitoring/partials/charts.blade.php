<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- Tren Bulanan --}}
    <div
        class="xl:col-span-2 bg-white/90 dark:bg-gray-800/90 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-gray-800 dark:text-white flex items-center">
                <i class="fa-solid fa-chart-column text-red-500 mr-2"></i> Tren Insiden & Korban per Bulan ({{ $tahun }})
            </h3>
        </div>
        <div class="h-72 md:h-80">
            <canvas id="chartBulanan" data-chart-fallback></canvas>
        </div>
    </div>

    {{-- Distribusi Jenis Insiden --}}
    <div
        class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 p-5">
        <h3 class="text-base font-bold text-gray-800 dark:text-white flex items-center mb-4">
            <i class="fa-solid fa-chart-pie text-purple-500 mr-2"></i> Jenis Insiden Terbanyak
        </h3>
        @if ($chartJenisValues->count() > 0)
            <div class="h-72 md:h-80">
                <canvas id="chartJenis" data-chart-fallback></canvas>
            </div>
        @else
            <div class="h-72 flex flex-col items-center justify-center text-center">
                <i class="fa-solid fa-chart-pie text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>
                <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada data insiden pada filter ini.</p>
            </div>
        @endif
    </div>

    {{-- Per Kecamatan --}}
    <div
        class="xl:col-span-3 bg-white/90 dark:bg-gray-800/90 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 p-5">
        <h3 class="text-base font-bold text-gray-800 dark:text-white flex items-center mb-4">
            <i class="fa-solid fa-map-location-dot text-cyan-500 mr-2"></i> Sebaran Insiden per Kecamatan Kota Banjarmasin
        </h3>
        <div class="h-64">
            <canvas id="chartKecamatan" data-chart-fallback></canvas>
        </div>
    </div>
</div>
