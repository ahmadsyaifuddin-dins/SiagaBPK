<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center">
            <div class="bg-green-100 dark:bg-green-900/30 p-2 rounded-lg mr-3 text-green-500">
                <i class="fa-solid fa-server"></i>
            </div>
            Status Sistem
        </h3>
    </div>

    <div class="p-6 space-y-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse shadow-[0_0_8px_rgba(34,197,94,0.8)]">
                </div>
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Server Aplikasi</span>
            </div>
            <span
                class="text-xs font-bold text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded-md border border-green-200 dark:border-green-800/30">Online</span>
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-2.5 h-2.5 bg-blue-500 rounded-full shadow-[0_0_8px_rgba(59,130,246,0.8)]"></div>
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Database Server</span>
            </div>
            <span
                class="text-xs font-bold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 px-2 py-1 rounded-md border border-blue-200 dark:border-blue-800/30">Connected</span>
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-2.5 h-2.5 bg-amber-500 rounded-full shadow-[0_0_8px_rgba(245,158,11,0.8)]"></div>
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Waktu Respon API</span>
            </div>
            <span
                class="text-xs font-bold text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded-md border border-green-200 dark:border-green-800/30">25
                ms</span>
        </div>

        <div class="pt-4 border-t border-gray-100 dark:border-gray-700 mt-2">
            <div class="text-xs text-center text-gray-500 dark:text-gray-400 flex items-center justify-center gap-1.5">
                <i class="fa-solid fa-arrows-rotate"></i>
                Pembaruan terakhir: {{ now()->format('H:i:s') }}
            </div>
        </div>
    </div>
</div>
