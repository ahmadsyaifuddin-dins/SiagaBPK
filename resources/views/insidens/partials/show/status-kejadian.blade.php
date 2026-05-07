<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <div
        class="px-6 py-4 bg-gradient-to-r from-red-50 to-orange-50 dark:from-red-900/20 dark:to-orange-900/20 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                <i class="fa-solid fa-satellite-dish text-red-600 dark:text-red-400"></i> Status Kejadian
            </h2>
            @php
                $statusColors = [
                    'Dilaporkan' =>
                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 border-yellow-200 dark:border-yellow-800',
                    'Berangkat' =>
                        'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 border-blue-200 dark:border-blue-800',
                    'Tiba di TKP' =>
                        'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400 border-orange-200 dark:border-orange-800',
                    'Selesai' =>
                        'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border-green-200 dark:border-green-800',
                ];
                $statusIcons = [
                    'Dilaporkan' => 'fa-bullhorn',
                    'Berangkat' => 'fa-truck-fast',
                    'Tiba di TKP' => 'fa-location-dot',
                    'Selesai' => 'fa-check-double',
                ];
            @endphp
            <span
                class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold border {{ $statusColors[$insiden->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                <i class="fa-solid {{ $statusIcons[$insiden->status] ?? 'fa-circle-info' }} mr-2"></i>
                {{ $insiden->status }}
            </span>
        </div>
    </div>
</div>
