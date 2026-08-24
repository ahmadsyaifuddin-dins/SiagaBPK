<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- Tabel Rekap per Kecamatan --}}
    <div
        class="xl:col-span-2 bg-white/90 dark:bg-gray-800/90 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-200/60 dark:border-gray-700/60 flex items-center justify-between">
            <h3 class="text-base font-bold text-gray-800 dark:text-white flex items-center">
                <i class="fa-solid fa-table-list text-indigo-500 mr-2"></i> Rekapitulasi Data per Kecamatan ({{ $tahun }})
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left bg-gray-50/80 dark:bg-gray-900/40 text-[11px] uppercase tracking-wider text-gray-500 dark:text-gray-400">
                        <th class="px-5 py-3 font-bold">Kecamatan</th>
                        <th class="px-3 py-3 font-bold text-center">Insiden</th>
                        <th class="px-3 py-3 font-bold text-center">Meninggal</th>
                        <th class="px-3 py-3 font-bold text-center">Luka</th>
                        <th class="px-3 py-3 font-bold text-center">Pengungsi<br>(KK / Jiwa)</th>
                        <th class="px-3 py-3 font-bold text-center">Rumah<br>Terdampak</th>
                        <th class="px-5 py-3 font-bold text-right">Kerugian Material</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60">
                    @foreach ($rekapKecamatan as $rekap)
                        <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-700/30 transition-colors">
                            <td class="px-5 py-3 font-semibold text-gray-800 dark:text-gray-200 whitespace-nowrap">
                                <i class="fa-solid fa-city text-cyan-500 mr-1.5 opacity-70"></i>{{ $rekap->kecamatan }}
                            </td>
                            <td class="px-3 py-3 text-center">
                                <span class="inline-flex min-w-7 justify-center px-2 py-0.5 rounded-md bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400 font-bold">{{ number_format($rekap->jumlah_insiden) }}</span>
                            </td>
                            <td class="px-3 py-3 text-center font-medium {{ $rekap->meninggal > 0 ? 'text-red-600 dark:text-red-400' : 'text-gray-400' }}">{{ number_format($rekap->meninggal) }}</td>
                            <td class="px-3 py-3 text-center font-medium {{ $rekap->luka > 0 ? 'text-orange-600 dark:text-orange-400' : 'text-gray-400' }}">{{ number_format($rekap->luka) }}</td>
                            <td class="px-3 py-3 text-center font-medium text-purple-600 dark:text-purple-400">{{ number_format($rekap->mengungsi_kk) }} / {{ number_format($rekap->mengungsi_jiwa) }}</td>
                            <td class="px-3 py-3 text-center font-medium text-amber-600 dark:text-amber-400">{{ number_format($rekap->total_rumah) }}</td>
                            <td class="px-5 py-3 text-right font-semibold text-gray-800 dark:text-gray-200 whitespace-nowrap">{{ $rekap->kerugian > 0 ? 'Rp ' . number_format($rekap->kerugian, 0, ',', '.') : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    @php
                        $total = [
                            'insiden' => $rekapKecamatan->sum('jumlah_insiden'),
                            'meninggal' => $rekapKecamatan->sum('meninggal'),
                            'luka' => $rekapKecamatan->sum('luka'),
                            'mengungsi_kk' => $rekapKecamatan->sum('mengungsi_kk'),
                            'mengungsi_jiwa' => $rekapKecamatan->sum('mengungsi_jiwa'),
                            'rumah' => $rekapKecamatan->sum('total_rumah'),
                            'kerugian' => $rekapKecamatan->sum('kerugian'),
                        ];
                    @endphp
                    <tr class="bg-gray-50/90 dark:bg-gray-900/50 font-bold text-gray-800 dark:text-gray-100 border-t-2 border-gray-200 dark:border-gray-600">
                        <td class="px-5 py-3 uppercase text-xs tracking-wider">Total</td>
                        <td class="px-3 py-3 text-center">{{ number_format($total['insiden']) }}</td>
                        <td class="px-3 py-3 text-center">{{ number_format($total['meninggal']) }}</td>
                        <td class="px-3 py-3 text-center">{{ number_format($total['luka']) }}</td>
                        <td class="px-3 py-3 text-center">{{ number_format($total['mengungsi_kk']) }} / {{ number_format($total['mengungsi_jiwa']) }}</td>
                        <td class="px-3 py-3 text-center">{{ number_format($total['rumah']) }}</td>
                        <td class="px-5 py-3 text-right whitespace-nowrap">{{ $total['kerugian'] > 0 ? 'Rp ' . number_format($total['kerugian'], 0, ',', '.') : '-' }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Kelurahan Rawan --}}
    <div
        class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 p-5">
        <h3 class="text-base font-bold text-gray-800 dark:text-white flex items-center mb-4">
            <i class="fa-solid fa-triangle-exclamation text-amber-500 mr-2"></i> 5 Kelurahan Paling Rawan ({{ $tahun }})
        </h3>

        @if ($topKelurahan->count() > 0)
            <div class="space-y-3">
                @foreach ($topKelurahan as $i => $kel)
                    <div
                        class="flex items-center gap-3 bg-gray-50/80 dark:bg-gray-900/40 rounded-xl p-3 border border-gray-100 dark:border-gray-700/60">
                        <div class="w-8 h-8 shrink-0 rounded-lg flex items-center justify-center text-sm font-extrabold text-white {{ $i === 0 ? 'bg-gradient-to-br from-red-500 to-orange-500' : ($i === 1 ? 'bg-gradient-to-br from-orange-400 to-amber-400' : 'bg-gradient-to-br from-slate-400 to-gray-500') }}">
                            {{ $i + 1 }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-sm text-gray-800 dark:text-gray-200 truncate">{{ $kel->kelurahan }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $kel->kecamatan }}</p>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-sm font-extrabold text-red-600 dark:text-red-400">{{ number_format($kel->jumlah) }} insiden</p>
                            <p class="text-[11px] text-gray-500 dark:text-gray-400">{{ number_format($kel->rumah) }} rumah terdampak</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-10 text-center">
                <i class="fa-solid fa-shield-heart text-4xl text-emerald-300 dark:text-emerald-700 mb-3"></i>
                <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada data kelurahan pada filter ini.</p>
            </div>
        @endif
    </div>
</div>
