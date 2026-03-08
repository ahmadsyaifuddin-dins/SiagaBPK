<div
    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700">
    <div class="p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('users.index') }}"
                    class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 p-3 rounded-xl transition-colors duration-200 text-gray-600 dark:text-gray-400">
                    <i class="fa-solid fa-arrow-left text-xl"></i>
                </a>
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-100 dark:bg-blue-900/30 p-3 rounded-xl text-blue-600 dark:text-blue-400">
                        <i class="fa-solid fa-address-card text-2xl w-8 h-8 flex items-center justify-center"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Petugas</h1>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Informasi lengkap anggota tim pemadam
                            kebakaran</p>
                    </div>
                </div>
            </div>

            @if (auth()->user()->role === 'admin')
                <a href="{{ route('users.edit', $user->id) }}"
                    class="hidden sm:flex bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-semibold shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 items-center gap-2">
                    <i class="fa-solid fa-user-pen"></i> Edit Profil
                </a>
            @endif
        </div>
    </div>
</div>
