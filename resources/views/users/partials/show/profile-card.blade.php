<div
    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700 relative">
    <div class="h-24 bg-gradient-to-r from-red-500 to-orange-500 w-full absolute top-0 left-0"></div>

    <div class="p-6 pt-12 relative z-10">
        <div
            class="flex flex-col md:flex-row items-center md:items-start text-center md:text-left space-y-4 md:space-y-0 md:space-x-6">

            <div class="flex-shrink-0">
                <div
                    class="h-28 w-28 rounded-full border-4 border-white dark:border-gray-800 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center shadow-lg">
                    <span
                        class="text-gray-700 dark:text-gray-300 font-bold text-4xl">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                </div>
            </div>

            <div class="flex-1 pt-2 md:pt-14">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                        <p class="text-gray-600 dark:text-gray-400 font-medium mt-1">
                            {{ $user->jabatan ?? 'Anggota Tim' }}</p>
                    </div>

                    <div class="flex flex-wrap justify-center gap-2">
                        <span
                            class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold shadow-sm {{ $user->role === 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300 border border-red-200 dark:border-red-800' : 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300 border border-green-200 dark:border-green-800' }}">
                            <i
                                class="fa-solid {{ $user->role === 'admin' ? 'fa-user-gear' : 'fa-helmet-safety' }} mr-2"></i>
                            {{ ucfirst($user->role) }}
                        </span>

                        <span
                            class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold shadow-sm {{ $user->status_aktif ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300 border border-blue-200 dark:border-blue-800' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 border border-gray-300 dark:border-gray-600' }}">
                            @if ($user->status_aktif)
                                <i class="fa-solid fa-circle-check mr-2"></i> Aktif
                            @else
                                <i class="fa-solid fa-circle-xmark mr-2"></i> Tidak Aktif
                            @endif
                        </span>
                    </div>
                </div>

                <div
                    class="mt-6 flex flex-col sm:flex-row gap-4 sm:gap-8 justify-center md:justify-start border-t border-gray-100 dark:border-gray-700 pt-6">
                    <div class="flex items-center text-gray-700 dark:text-gray-300">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mr-3">
                            <i class="fa-solid fa-envelope text-gray-500 dark:text-gray-400"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Email</p>
                            <p class="font-semibold">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="flex items-center text-gray-700 dark:text-gray-300">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mr-3">
                            <i class="fa-solid fa-phone text-gray-500 dark:text-gray-400"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">No. Handphone</p>
                            <p class="font-semibold">{{ $user->no_hp ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
