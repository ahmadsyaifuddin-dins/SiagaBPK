<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center">
                <div class="bg-red-100 dark:bg-red-900/30 p-2 rounded-lg mr-3">
                    <i class="fa-solid fa-fire text-red-500"></i>
                </div>
                Insiden Terbaru
            </h3>
            <div
                class="flex items-center space-x-2 bg-red-50 dark:bg-red-900/20 px-3 py-1 rounded-full border border-red-100 dark:border-red-800/30">
                <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                <span class="text-xs font-bold text-red-600 dark:text-red-400 uppercase tracking-wider">Live</span>
            </div>
        </div>
    </div>

    <div class="p-6">
        @if (isset($insidenTerbaru) && $insidenTerbaru->count() > 0)
            <div class="space-y-4">
                @foreach ($insidenTerbaru as $item)
                    <div
                        class="group p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 border-l-4 
                        @if ($item->status == 'Selesai') border-green-500 
                        @elseif($item->status == 'Tiba di TKP') border-blue-500 
                        @elseif($item->status == 'Berangkat') border-yellow-500 
                        @else border-red-500 @endif">

                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <i class="fa-solid fa-location-dot text-gray-400 dark:text-gray-500"></i>
                                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $item->lokasi }}</h4>
                                </div>
                                <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 pl-6">
                                    <i class="fa-regular fa-clock"></i>
                                    <span>{{ \Carbon\Carbon::parse($item->waktu_kejadian)->translatedFormat('d M Y, H:i') }}
                                        WITA</span>
                                </div>
                            </div>

                            <div class="ml-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold shadow-sm
                                    @if ($item->status == 'Selesai') bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400 border border-green-200 dark:border-green-800
                                    @elseif($item->status == 'Tiba di TKP') bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-400 border border-blue-200 dark:border-blue-800
                                    @elseif($item->status == 'Berangkat') bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800
                                    @else bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400 border border-red-200 dark:border-red-800 @endif">
                                    {{ strtoupper($item->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-10">
                <div
                    class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-clipboard-check text-3xl text-gray-400 dark:text-gray-500"></i>
                </div>
                <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Tidak ada insiden</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Belum ada insiden yang dilaporkan hari ini,
                    situasi aman.</p>
            </div>
        @endif
    </div>
</div>
