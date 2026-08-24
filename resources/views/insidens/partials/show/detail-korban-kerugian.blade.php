@php
    $adaDetailKorban = $insiden->total_korban_jiwa > 0 || $insiden->korban_jiwa_terdampak > 0 ||
        $insiden->korban_mengungsi_kk > 0 || $insiden->korban_mengungsi_jiwa > 0;
    $adaDetailKerugian = (int) $insiden->kerugian_material > 0 || $insiden->rumah_terbakar > 0 ||
        $insiden->rumah_rusak > 0 || $insiden->bangunan_lain_terdampak > 0 || $insiden->kendaraan_terbakar > 0 ||
        $insiden->luas_area_dampak > 0;

    $itemKorban = [
        ['label' => 'Meninggal Dunia', 'icon' => 'fa-heart-crack', 'warna' => 'red', 'nilai' => $insiden->korban_meninggal, 'satuan' => 'jiwa'],
        ['label' => 'Luka Berat', 'icon' => 'fa-user-injured', 'warna' => 'orange', 'nilai' => $insiden->korban_luka_berat, 'satuan' => 'jiwa'],
        ['label' => 'Luka Ringan', 'icon' => 'fa-band-aid', 'warna' => 'yellow', 'nilai' => $insiden->korban_luka_ringan, 'satuan' => 'jiwa'],
        ['label' => 'Total Jiwa Terdampak', 'icon' => 'fa-users', 'warna' => 'purple', 'nilai' => $insiden->korban_jiwa_terdampak, 'satuan' => 'jiwa'],
        ['label' => 'Pengungsi (KK)', 'icon' => 'fa-house-circle-exclamation', 'warna' => 'indigo', 'nilai' => $insiden->korban_mengungsi_kk, 'satuan' => 'KK'],
        ['label' => 'Pengungsi (Jiwa)', 'icon' => 'fa-people-roof', 'warna' => 'blue', 'nilai' => $insiden->korban_mengungsi_jiwa, 'satuan' => 'jiwa'],
    ];

    $itemKerugian = [
        ['label' => 'Rumah Terbakar', 'icon' => 'fa-fire', 'warna' => 'red', 'nilai' => $insiden->rumah_terbakar, 'satuan' => 'unit'],
        ['label' => 'Rumah Rusak', 'icon' => 'fa-house-chimney-crack', 'warna' => 'amber', 'nilai' => $insiden->rumah_rusak, 'satuan' => 'unit'],
        ['label' => 'Bangunan Lain', 'icon' => 'fa-store', 'warna' => 'emerald', 'nilai' => $insiden->bangunan_lain_terdampak, 'satuan' => 'unit'],
        ['label' => 'Kendaraan Terbakar', 'icon' => 'fa-motorcycle', 'warna' => 'sky', 'nilai' => $insiden->kendaraan_terbakar, 'satuan' => 'unit'],
        ['label' => 'Luas Area Terdampak', 'icon' => 'fa-ruler-combined', 'warna' => 'lime', 'nilai' => rtrim(rtrim(number_format($insiden->luas_area_dampak, 2, ',', '.'), '0'), ','), 'satuan' => 'm²'],
        ['label' => 'Taksiran Kerugian', 'icon' => 'fa-sack-dollar', 'warna' => 'rose', 'nilai' => (int) $insiden->kerugian_material > 0 ? $insiden->kerugian_material_format : '0', 'satuan' => (int) $insiden->kerugian_material > 0 ? '' : 'Rp'],
    ];

    $bgWarna = [
        'red' => 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400',
        'orange' => 'bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400',
        'amber' => 'bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400',
        'yellow' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400',
        'lime' => 'bg-lime-100 dark:bg-lime-900/30 text-lime-600 dark:text-lime-400',
        'emerald' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400',
        'sky' => 'bg-sky-100 dark:bg-sky-900/30 text-sky-600 dark:text-sky-400',
        'blue' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400',
        'indigo' => 'bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400',
        'purple' => 'bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400',
        'rose' => 'bg-rose-100 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400',
    ];
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Detail Korban --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div
            class="px-5 py-3 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-sm font-bold text-gray-800 dark:text-white flex items-center uppercase tracking-wide">
                <i class="fa-solid fa-users-viewfinder text-purple-600 dark:text-purple-400 mr-2"></i> Detail Data Korban
            </h3>
        </div>
        <div class="p-5">
            @if ($adaDetailKorban)
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach ($itemKorban as $item)
                        <div
                            class="flex flex-col items-center text-center bg-gray-50 dark:bg-gray-900/40 rounded-xl p-3 border border-gray-100 dark:border-gray-700">
                            <div class="p-2 rounded-full mb-1.5 {{ $bgWarna[$item['warna']] }}">
                                <i class="fa-solid {{ $item['icon'] }} text-sm"></i>
                            </div>
                            <p class="text-lg font-extrabold text-gray-900 dark:text-white leading-none">
                                {{ number_format($item['nilai'], 0, ',', '.') }}
                                <span class="text-[10px] font-medium text-gray-400">{{ $item['satuan'] }}</span>
                            </p>
                            <p class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 mt-1 uppercase tracking-wide">{{ $item['label'] }}</p>
                        </div>
                    @endforeach
                </div>

                @if ($insiden->korban_mengungsi_jiwa > 0)
                    <div
                        class="mt-4 text-xs text-indigo-700 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-100 dark:border-indigo-800/50 rounded-lg px-3 py-2 flex items-center">
                        <i class="fa-solid fa-circle-info mr-2"></i> Pengungsian menjangkau
                        <b class="mx-1">{{ $insiden->korban_mengungsi_kk }}</b> KK dengan total
                        <b class="mx-1">{{ number_format($insiden->korban_mengungsi_jiwa, 0, ',', '.') }}</b> jiwa mengungsi.
                    </div>
                @endif
            @else
                <div class="text-center py-6">
                    <i class="fa-solid fa-user-shield text-3xl text-gray-300 dark:text-gray-600 mb-2"></i>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada data korban jiwa pada kejadian ini.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Detail Kerugian --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div
            class="px-5 py-3 bg-gradient-to-r from-red-50 to-orange-50 dark:from-red-900/20 dark:to-orange-900/20 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-sm font-bold text-gray-800 dark:text-white flex items-center uppercase tracking-wide">
                <i class="fa-solid fa-house-crack text-red-600 dark:text-red-400 mr-2"></i> Detail Kerugian & Kerusakan
            </h3>
        </div>
        <div class="p-5">
            @if ($adaDetailKerugian)
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach ($itemKerugian as $item)
                        <div
                            class="flex flex-col items-center text-center bg-gray-50 dark:bg-gray-900/40 rounded-xl p-3 border border-gray-100 dark:border-gray-700">
                            <div class="p-2 rounded-full mb-1.5 {{ $bgWarna[$item['warna']] }}">
                                <i class="fa-solid {{ $item['icon'] }} text-sm"></i>
                            </div>
                            <p class="text-base font-extrabold text-gray-900 dark:text-white leading-none truncate max-w-full"
                                title="{{ $item['nilai'] }} {{ $item['satuan'] }}">
                                @if ((int) $insiden->kerugian_material > 0 && $item['label'] === 'Taksiran Kerugian')
                                    {{ $item['nilai'] }}
                                @else
                                    {{ number_format((float) str_replace('.', '', $item['nilai']), 0, ',', '.') }}
                                    <span class="text-[10px] font-medium text-gray-400">{{ $item['satuan'] }}</span>
                                @endif
                            </p>
                            <p class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 mt-1 uppercase tracking-wide">{{ $item['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-6">
                    <i class="fa-solid fa-box-open text-3xl text-gray-300 dark:text-gray-600 mb-2"></i>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada catatan kerugian material.</p>
                </div>
            @endif
        </div>
    </div>
</div>
