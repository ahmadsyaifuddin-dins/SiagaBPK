@php
    $kartuStatistik = [
        ['label' => 'Total Insiden', 'sub' => $statistik['belum_selesai'] . ' belum selesai', 'nilai' => number_format($statistik['total_insiden']), 'icon' => 'fa-fire-extinguisher', 'gradasi' => 'from-red-500 to-orange-400'],
        ['label' => 'Meninggal Dunia', 'sub' => 'korban jiwa', 'nilai' => number_format($statistik['total_meninggal']), 'icon' => 'fa-heart-crack', 'gradasi' => 'from-rose-600 to-red-500'],
        ['label' => 'Korban Luka', 'sub' => 'luka berat & ringan', 'nilai' => number_format($statistik['total_luka']), 'icon' => 'fa-user-injured', 'gradasi' => 'from-orange-500 to-amber-400'],
        ['label' => 'Warga Mengungsi', 'sub' => number_format($statistik['total_mengungsi_kk']) . ' KK terdampak', 'nilai' => number_format($statistik['total_mengungsi_jiwa']), 'icon' => 'fa-people-roof', 'gradasi' => 'from-purple-500 to-indigo-400'],
        ['label' => 'Rumah Terdampak', 'sub' => number_format($statistik['total_rumah_terbakar']) . ' terbakar / ' . number_format($statistik['total_rumah_rusak']) . ' rusak', 'nilai' => number_format($statistik['total_rumah_terbakar'] + $statistik['total_rumah_rusak']), 'icon' => 'fa-house-chimney-crack', 'gradasi' => 'from-amber-500 to-yellow-400'],
        ['label' => 'Kerugian Material', 'sub' => 'taksiran total kerugian', 'nilai' => $statistik['total_kerugian'] > 0 ? 'Rp ' . number_format($statistik['total_kerugian'] / 1000000000, 2, ',', '.') . ' M' : 'Rp 0', 'icon' => 'fa-sack-dollar', 'gradasi' => 'from-emerald-500 to-teal-400'],
    ];
@endphp

<div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
    @foreach ($kartuStatistik as $kartu)
        <div
            class="relative overflow-hidden bg-white/90 dark:bg-gray-800/90 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 p-4">
            <div class="absolute -right-4 -top-4 w-20 h-20 bg-gradient-to-br {{ $kartu['gradasi'] }} opacity-10 rounded-full blur-xl"></div>
            <div class="flex items-center justify-between mb-3">
                <div class="bg-gradient-to-br {{ $kartu['gradasi'] }} text-white p-2 rounded-lg shadow-md">
                    <i class="fa-solid {{ $kartu['icon'] }} text-sm"></i>
                </div>
            </div>
            <p class="text-xl xl:text-2xl font-extrabold text-gray-900 dark:text-white leading-tight">{{ $kartu['nilai'] }}</p>
            <p class="text-xs font-bold text-gray-600 dark:text-gray-300 mt-0.5">{{ $kartu['label'] }}</p>
            <p class="text-[11px] text-gray-400 dark:text-gray-500 mt-0.5">{{ $kartu['sub'] }}</p>
        </div>
    @endforeach
</div>

{{-- Ringkasan tambahan --}}
<div
    class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 px-5 py-3.5 flex flex-wrap items-center gap-x-8 gap-y-2 text-sm">
    <span class="font-bold text-gray-700 dark:text-gray-200 uppercase text-xs tracking-wider flex items-center gap-2">
        <i class="fa-solid fa-clipboard-list text-indigo-500"></i> Data Kejadian {{ $tahun }}:
    </span>
    <span class="text-gray-600 dark:text-gray-300"><i class="fa-solid fa-store text-emerald-500 mr-1.5"></i> Bangunan lain terdampak: <b class="text-gray-900 dark:text-white">{{ number_format($statistik['total_bangunan_lain']) }} unit</b></span>
    <span class="text-gray-600 dark:text-gray-300"><i class="fa-solid fa-motorcycle text-sky-500 mr-1.5"></i> Kendaraan terbakar: <b class="text-gray-900 dark:text-white">{{ number_format($statistik['total_kendaraan']) }} unit</b></span>
    <span class="text-gray-600 dark:text-gray-300"><i class="fa-solid fa-ruler-combined text-lime-600 mr-1.5"></i> Luas area terdampak: <b class="text-gray-900 dark:text-white">{{ number_format($statistik['total_luas_dampak'], 0, ',', '.') }} m²</b></span>
    <span class="text-gray-600 dark:text-gray-300"><i class="fa-solid fa-users text-purple-500 mr-1.5"></i> Jiwa terdampak: <b class="text-gray-900 dark:text-white">{{ number_format($statistik['total_jiwa_terdampak']) }} jiwa</b></span>
</div>
