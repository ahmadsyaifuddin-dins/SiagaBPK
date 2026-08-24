<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <div
        class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center">
            <i class="fa-solid fa-circle-info text-red-600 dark:text-red-400 mr-2"></i> Informasi Kejadian
        </h3>
    </div>
    <div class="p-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 pb-8 border-b border-gray-100 dark:border-gray-700">
            <div class="flex items-start space-x-3">
                <div class="p-2.5 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg shrink-0">
                    <i class="fa-solid fa-user-shield text-indigo-600 dark:text-indigo-400 text-lg"></i>
                </div>
                <div class="flex-1 mt-1">
                    <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-0.5">Nama
                        Pelapor (Warga/Instansi)</p>
                    <p class="text-gray-900 dark:text-white font-medium">
                        {{ $insiden->nama_pelapor ?? 'Tidak diketahui (Anonim)' }}</p>
                    @if ($insiden->pelapor)
                        <p class="text-xs text-gray-400 mt-1">* Diterima oleh: {{ $insiden->pelapor->name }}</p>
                    @endif
                </div>
            </div>

            <div class="flex-1 mt-1">
                <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-0.5">Kontak
                    Pelapor</p>
                @if ($insiden->kontak_pelapor)
                    @php
                        // 1. Bersihkan nomor dari spasi atau strip (misal: 0812-3456 -> 08123456)
                        $rawNumber = preg_replace('/[^0-9]/', '', $insiden->kontak_pelapor);

                        // 2. Jika depannya 08, ubah 0 menjadi 62
                        if (substr($rawNumber, 0, 2) === '08') {
                            $waNumber = '62' . substr($rawNumber, 1);
                        } else {
                            $waNumber = $rawNumber;
                        }
                    @endphp

                    <a href="https://wa.me/{{ $waNumber }}" target="_blank"
                        class="inline-flex items-center text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 font-medium hover:underline">
                        {{ $insiden->kontak_pelapor }} <i class="fa-brands fa-whatsapp ml-1"></i>
                    </a>
                @else
                    <p class="text-gray-900 dark:text-white font-medium">-</p>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-6">
                <div
                    class="flex items-start space-x-3 bg-gray-50 dark:bg-gray-900/50 p-4 rounded-xl border border-gray-100 dark:border-gray-700">
                    <div class="p-2.5 bg-red-100 dark:bg-red-900/30 rounded-lg shrink-0">
                        <i class="fa-solid fa-map-location-dot text-red-600 dark:text-red-400 text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">
                            Lokasi Kejadian</p>
                        <p class="text-gray-900 dark:text-white font-semibold text-lg leading-tight mb-2">
                            {{ $insiden->lokasi }}</p>

                        @if ($insiden->kelurahan || $insiden->kecamatan)
                            <div class="flex flex-wrap gap-1.5 mb-2">
                                @if ($insiden->kelurahan)
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 bg-teal-100 text-teal-700 dark:bg-teal-900/40 dark:text-teal-400 rounded-md text-xs font-semibold">
                                        <i class="fa-solid fa-map-pin"></i> Kel. {{ $insiden->kelurahan }}</span>
                                @endif
                                @if ($insiden->kecamatan)
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 bg-cyan-100 text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-400 rounded-md text-xs font-semibold">
                                        <i class="fa-solid fa-city"></i> Kec. {{ $insiden->kecamatan }}</span>
                                @endif
                            </div>
                        @endif

                        @if ($insiden->latitude && $insiden->longitude)
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $insiden->latitude }},{{ $insiden->longitude }}"
                                target="_blank"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-100 text-blue-700 hover:bg-blue-200 dark:bg-blue-900/40 dark:text-blue-400 dark:hover:bg-blue-800/50 rounded-lg text-xs font-bold transition-colors shadow-sm">
                                <i class="fa-solid fa-location-arrow"></i> Buka Rute di Peta (GPS)
                            </a>
                        @else
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400 rounded-lg text-xs font-medium border border-gray-200 dark:border-gray-700 cursor-not-allowed">
                                <i class="fa-solid fa-ban"></i> Koordinat GPS Tidak Tersedia
                            </span>
                        @endif
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="p-2.5 bg-orange-100 dark:bg-orange-900/30 rounded-lg shrink-0">
                        <i class="fa-solid fa-fire text-orange-600 dark:text-orange-400 text-lg"></i>
                    </div>
                    <div class="flex-1 mt-1">
                        <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-0.5">
                            Jenis Insiden</p>
                        <p class="text-gray-900 dark:text-white font-medium">{{ $insiden->jenis_insiden ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="flex items-start space-x-3">
                    <div class="p-2.5 bg-blue-100 dark:bg-blue-900/30 rounded-lg shrink-0">
                        <i class="fa-solid fa-clock text-blue-600 dark:text-blue-400 text-lg"></i>
                    </div>
                    <div class="flex-1 mt-1">
                        <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-0.5">
                            Waktu Kejadian</p>
                        <p class="text-gray-900 dark:text-white font-medium">
                            {{ \Carbon\Carbon::parse($insiden->waktu_kejadian)->format('d M Y - H:i') }} WITA</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="p-2.5 bg-purple-100 dark:bg-purple-900/30 rounded-lg shrink-0">
                        <i class="fa-solid fa-users text-purple-600 dark:text-purple-400 text-lg"></i>
                    </div>
                    <div class="flex-1 mt-1">
                        <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-0.5">
                            Total Korban Jiwa</p>
                        <p class="text-gray-900 dark:text-white font-medium">{{ $insiden->total_korban_jiwa }} orang
                        </p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="p-2.5 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg shrink-0">
                        <i class="fa-solid fa-sack-dollar text-yellow-600 dark:text-yellow-400 text-lg"></i>
                    </div>
                    <div class="flex-1 mt-1">
                        <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-0.5">
                            Taksiran Kerugian</p>
                        <p class="text-gray-900 dark:text-white font-medium">
                            @if ((int) $insiden->kerugian_material > 0)
                                {{ $insiden->kerugian_material_format }}
                            @elseif (is_numeric($insiden->kerugian))
                                Rp {{ number_format((float) $insiden->kerugian, 0, ',', '.') }}
                            @else
                                {{ $insiden->kerugian ?? 'Belum diketahui' }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
