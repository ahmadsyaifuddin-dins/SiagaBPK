<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center">
            <div class="bg-yellow-100 dark:bg-yellow-900/30 p-2 rounded-lg mr-3 text-yellow-500">
                <i class="fa-solid fa-bolt"></i>
            </div>
            Jalan Pintas
        </h3>
    </div>

    <div class="p-6 space-y-3">
        <a href="{{ route('insidens.create') }}"
            class="group w-full flex items-center justify-between px-4 py-3.5 bg-gray-50 hover:bg-red-500 dark:bg-gray-700/50 dark:hover:bg-red-600 text-gray-700 hover:text-white dark:text-gray-200 rounded-xl transition-all duration-200 border border-gray-200 dark:border-gray-600 hover:border-red-500 shadow-sm hover:shadow-md">
            <div class="flex items-center font-semibold">
                <div
                    class="w-8 h-8 rounded-lg bg-red-100 text-red-500 group-hover:bg-white/20 group-hover:text-white flex items-center justify-center mr-3 transition-colors">
                    <i class="fa-solid fa-fire"></i>
                </div>
                Lapor Insiden Baru
            </div>
            <i
                class="fa-solid fa-chevron-right opacity-50 group-hover:opacity-100 group-hover:translate-x-1 transition-all"></i>
        </a>

        @if (auth()->user()->role === 'admin')
            <a href="{{ route('jadwal_siaga.create') }}"
                class="group w-full flex items-center justify-between px-4 py-3.5 bg-gray-50 hover:bg-amber-500 dark:bg-gray-700/50 dark:hover:bg-amber-600 text-gray-700 hover:text-white dark:text-gray-200 rounded-xl transition-all duration-200 border border-gray-200 dark:border-gray-600 hover:border-amber-500 shadow-sm hover:shadow-md">
                <div class="flex items-center font-semibold">
                    <div
                        class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 group-hover:bg-white/20 group-hover:text-white flex items-center justify-center mr-3 transition-colors">
                        <i class="fa-regular fa-calendar-plus"></i>
                    </div>
                    Atur Jadwal Siaga
                </div>
                <i
                    class="fa-solid fa-chevron-right opacity-50 group-hover:opacity-100 group-hover:translate-x-1 transition-all"></i>
            </a>
        @endif

        <a href="{{ route('users.index') }}"
            class="group w-full flex items-center justify-between px-4 py-3.5 bg-gray-50 hover:bg-blue-500 dark:bg-gray-700/50 dark:hover:bg-blue-600 text-gray-700 hover:text-white dark:text-gray-200 rounded-xl transition-all duration-200 border border-gray-200 dark:border-gray-600 hover:border-blue-500 shadow-sm hover:shadow-md">
            <div class="flex items-center font-semibold">
                <div
                    class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 group-hover:bg-white/20 group-hover:text-white flex items-center justify-center mr-3 transition-colors">
                    <i class="fa-solid fa-users-viewfinder"></i>
                </div>
                Daftar Petugas
            </div>
            <i
                class="fa-solid fa-chevron-right opacity-50 group-hover:opacity-100 group-hover:translate-x-1 transition-all"></i>
        </a>

        <a href="{{ route('laporan-lengkap') }}" target="_blank"
            class="group w-full flex items-center justify-between px-4 py-3.5 bg-gray-50 hover:bg-purple-500 dark:bg-gray-700/50 dark:hover:bg-purple-600 text-gray-700 hover:text-white dark:text-gray-200 rounded-xl transition-all duration-200 border border-gray-200 dark:border-gray-600 hover:border-purple-500 shadow-sm hover:shadow-md">
            <div class="flex items-center font-semibold">
                <div
                    class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 group-hover:bg-white/20 group-hover:text-white flex items-center justify-center mr-3 transition-colors">
                    <i class="fa-solid fa-file-pdf"></i>
                </div>
                Cetak Laporan PDF
            </div>
            <i
                class="fa-solid fa-chevron-right opacity-50 group-hover:opacity-100 group-hover:translate-x-1 transition-all"></i>
        </a>
    </div>
</div>
