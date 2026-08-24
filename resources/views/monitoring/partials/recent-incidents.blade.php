<div
    class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-200/60 dark:border-gray-700/60 flex flex-wrap items-center justify-between gap-2">
        <h3 class="text-base font-bold text-gray-800 dark:text-white flex items-center">
            <i class="fa-solid fa-clock-rotate-left text-blue-500 mr-2"></i> Kejadian Terbaru ({{ $tahun }})
        </h3>
        <a href="{{ route('insidens.index') }}"
            class="text-xs font-bold text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 uppercase tracking-wide transition-colors">
            Lihat Semua Insiden <i class="fa-solid fa-arrow-right ml-1"></i>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left bg-gray-50/80 dark:bg-gray-900/40 text-[11px] uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    <th class="px-5 py-3 font-bold">Kejadian</th>
                    <th class="px-3 py-3 font-bold">Lokasi</th>
                    <th class="px-3 py-3 font-bold text-center">Korban</th>
                    <th class="px-3 py-3 font-bold text-center">Rumah</th>
                    <th class="px-3 py-3 font-bold text-right">Kerugian</th>
                    <th class="px-5 py-3 font-bold text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60">
                @forelse ($insidenTerbaru as $insiden)
                    @php
                        $statusColors = [
                            'Dilaporkan' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                            'Berangkat' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                            'Tiba di TKP' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                            'Selesai' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                        ];
                        $totalKorban = $insiden->korban_meninggal + $insiden->korban_luka_berat + $insiden->korban_luka_ringan;
                    @endphp
                    <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-700/30 transition-colors">
                        <td class="px-5 py-3">
                            <a href="{{ route('insidens.show', $insiden->id) }}"
                                class="font-semibold text-gray-800 dark:text-gray-200 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                {{ $insiden->jenis_insiden ?? '-' }}
                            </a>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                {{ \Carbon\Carbon::parse($insiden->waktu_kejadian)->translatedFormat('d M Y, H.i') }} WITA
                            </p>
                        </td>
                        <td class="px-3 py-3 max-w-[220px]">
                            <p class="truncate text-gray-700 dark:text-gray-300" title="{{ $insiden->lokasi }}">{{ $insiden->lokasi }}</p>
                            <p class="text-xs text-cyan-600 dark:text-cyan-400 mt-0.5 truncate">
                                {{ $insiden->kelurahan ? 'Kel. ' . $insiden->kelurahan : '-' }}{{ $insiden->kecamatan ? ' — ' . $insiden->kecamatan : '' }}
                            </p>
                        </td>
                        <td class="px-3 py-3 text-center whitespace-nowrap">
                            @if ($totalKorban > 0)
                                <span class="inline-flex min-w-7 justify-center px-2 py-0.5 rounded-md bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-400 font-bold">{{ $totalKorban }}</span>
                                <p class="text-[11px] text-gray-400 mt-0.5">jiwa</p>
                            @else
                                <span class="text-gray-300 dark:text-gray-600">—</span>
                            @endif
                        </td>
                        <td class="px-3 py-3 text-center whitespace-nowrap">
                            @if (($insiden->rumah_terbakar + $insiden->rumah_rusak) > 0)
                                <span class="inline-flex min-w-7 justify-center px-2 py-0.5 rounded-md bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-400 font-bold">{{ $insiden->rumah_terbakar + $insiden->rumah_rusak }}</span>
                                <p class="text-[11px] text-gray-400 mt-0.5">unit</p>
                            @else
                                <span class="text-gray-300 dark:text-gray-600">—</span>
                            @endif
                        </td>
                        <td class="px-3 py-3 text-right font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap">
                            {{ $insiden->kerugian_material > 0 ? 'Rp ' . number_format($insiden->kerugian_material, 0, ',', '.') : '-' }}
                        </td>
                        <td class="px-5 py-3 text-center">
                            <span class="inline-block px-2.5 py-1 rounded-full text-[11px] font-bold whitespace-nowrap {{ $statusColors[$insiden->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $insiden->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center">
                            <i class="fa-solid fa-fire-extinguisher text-4xl text-gray-300 dark:text-gray-600 mb-3"></i>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada data kejadian sesuai filter.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
