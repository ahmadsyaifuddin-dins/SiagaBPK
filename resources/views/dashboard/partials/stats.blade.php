<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div
        class="group relative overflow-hidden bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 dark:from-blue-600 dark:via-blue-700 dark:to-blue-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
        <div
            class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        </div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-white/20 dark:bg-white/10 rounded-xl backdrop-blur-sm">
                    <i
                        class="fa-solid fa-fire-extinguisher text-white text-xl w-6 h-6 flex items-center justify-center"></i>
                </div>
                <div class="text-right">
                    <div class="text-white/80 text-sm font-medium">Trend</div>
                    <div class="text-white text-xs font-bold bg-white/20 px-2 py-0.5 rounded-full mt-1">+12%</div>
                </div>
            </div>
            <div class="text-white">
                <div class="text-4xl font-bold mb-1">{{ $totalInsiden ?? 0 }}</div>
                <div class="text-blue-100 text-sm font-medium">Total Insiden</div>
            </div>
        </div>
    </div>

    <div
        class="group relative overflow-hidden bg-gradient-to-br from-emerald-500 via-emerald-600 to-emerald-700 dark:from-emerald-600 dark:via-emerald-700 dark:to-emerald-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
        <div
            class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        </div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-white/20 dark:bg-white/10 rounded-xl backdrop-blur-sm">
                    <i class="fa-solid fa-users text-white text-xl w-6 h-6 flex items-center justify-center"></i>
                </div>
                <div class="text-right">
                    <div class="text-white/80 text-sm font-medium">Active</div>
                    <div class="text-white text-xs font-bold bg-white/20 px-2 py-0.5 rounded-full mt-1">
                        {{ isset($totalUser) ? round($totalUser * 0.8) : 0 }}</div>
                </div>
            </div>
            <div class="text-white">
                <div class="text-4xl font-bold mb-1">{{ $totalUser ?? 0 }}</div>
                <div class="text-emerald-100 text-sm font-medium">Total Petugas</div>
            </div>
        </div>
    </div>

    <div
        class="group relative overflow-hidden bg-gradient-to-br from-amber-500 via-amber-600 to-amber-700 dark:from-amber-600 dark:via-amber-700 dark:to-amber-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
        <div
            class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        </div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-white/20 dark:bg-white/10 rounded-xl backdrop-blur-sm">
                    <i
                        class="fa-solid fa-calendar-check text-white text-xl w-6 h-6 flex items-center justify-center"></i>
                </div>
                <div class="text-right">
                    <div class="text-white/80 text-sm font-medium">Monthly</div>
                    <div class="text-white text-xs font-bold bg-white/20 px-2 py-0.5 rounded-full mt-1">
                        {{ isset($totalJadwal) ? round($totalJadwal / 12) : 0 }}</div>
                </div>
            </div>
            <div class="text-white">
                <div class="text-4xl font-bold mb-1">{{ $totalJadwal ?? 0 }}</div>
                <div class="text-amber-100 text-sm font-medium">Total Jadwal Siaga</div>
            </div>
        </div>
    </div>

    <div
        class="group relative overflow-hidden bg-gradient-to-br from-purple-500 via-purple-600 to-purple-700 dark:from-purple-600 dark:via-purple-700 dark:to-purple-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
        <div
            class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        </div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-white/20 dark:bg-white/10 rounded-xl backdrop-blur-sm">
                    <i class="fa-solid fa-user-shield text-white text-xl w-6 h-6 flex items-center justify-center"></i>
                </div>
                <div class="text-right">
                    <div class="text-white/80 text-sm font-medium">Status</div>
                    <div
                        class="text-white text-xs font-bold bg-white/20 px-2 py-0.5 rounded-full mt-1 flex items-center justify-center">
                        <div class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1.5 animate-pulse"></div> Online
                    </div>
                </div>
            </div>
            <div class="text-white">
                <div class="text-4xl font-bold mb-1">{{ $relawanHariIni ?? 0 }}</div>
                <div class="text-purple-100 text-sm font-medium">Relawan Hari Ini</div>
            </div>
        </div>
    </div>
</div>
