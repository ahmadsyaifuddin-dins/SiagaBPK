<div class="space-y-6">
    <div
        class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div
            class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center">
                <i class="fa-solid fa-bullhorn text-purple-600 dark:text-purple-400 mr-2"></i> Identitas Pelapor
            </h3>
        </div>
        <div class="p-6">
            @if ($insiden->pelapor)
                <div
                    class="flex items-center space-x-3 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-100 dark:border-blue-800/50">
                    <div class="p-2.5 bg-blue-100 dark:bg-blue-900/30 rounded-full shrink-0">
                        <i class="fa-solid fa-user-shield text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 dark:text-white">{{ $insiden->pelapor->name }}</p>
                        <p class="text-sm font-medium text-blue-600 dark:text-blue-400">Petugas Internal</p>
                    </div>
                </div>
            @elseif($insiden->nama_pelapor)
                <div class="space-y-3">
                    <div
                        class="flex items-center space-x-3 p-4 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl border border-emerald-100 dark:border-emerald-800/50">
                        <div class="p-2.5 bg-emerald-100 dark:bg-emerald-900/30 rounded-full shrink-0">
                            <i class="fa-solid fa-user text-emerald-600 dark:text-emerald-400"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 dark:text-white">{{ $insiden->nama_pelapor }}</p>
                            <p class="text-sm font-medium text-emerald-600 dark:text-emerald-400">Masyarakat Umum</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 text-sm font-medium text-gray-600 dark:text-gray-400 px-2">
                        <i class="fa-solid fa-phone"></i>
                        <span>{{ $insiden->kontak_pelapor }}</span>
                    </div>
                </div>
            @else
                <div
                    class="flex items-center justify-center p-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-100 dark:border-gray-600">
                    <div class="text-center">
                        <i class="fa-solid fa-user-secret text-3xl text-gray-400 dark:text-gray-500 mb-2"></i>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">Pelapor tidak diketahui</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div
        class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div
            class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center">
                <i class="fa-solid fa-users-gear text-blue-600 dark:text-blue-400 mr-2"></i> Petugas Bertugas
            </h3>
        </div>
        <div class="p-6">
            @forelse($insiden->petugas as $petugas)
                <div
                    class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-100 dark:border-gray-700 {{ !$loop->last ? 'mb-3' : '' }}">
                    <div class="p-2.5 bg-red-100 dark:bg-red-900/30 rounded-full shrink-0">
                        <i class="fa-solid fa-helmet-safety text-red-600 dark:text-red-400"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 dark:text-white leading-tight">{{ $petugas->name }}</p>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">BPK KTC Fire</p>
                    </div>
                </div>
            @empty
                <div
                    class="flex items-center justify-center p-6 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl border border-yellow-100 dark:border-yellow-800/50">
                    <div class="text-center">
                        <i class="fa-solid fa-user-clock text-3xl text-yellow-500 dark:text-yellow-400 mb-2"></i>
                        <p class="text-yellow-700 dark:text-yellow-300 font-bold">Belum Ada Petugas</p>
                        <p class="text-xs text-yellow-600 dark:text-yellow-400 mt-1">Status laporan masih tahap awal</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
