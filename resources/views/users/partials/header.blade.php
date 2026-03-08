<div
    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl mb-6 border border-gray-100 dark:border-gray-700">
    <div class="p-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center space-x-4">
                <div
                    class="bg-gradient-to-br from-red-100 to-orange-100 dark:from-red-900/40 dark:to-orange-900/40 p-3.5 rounded-2xl shadow-inner">
                    <i
                        class="fa-solid fa-users-gear text-2xl text-red-600 dark:text-red-400 w-8 h-8 flex items-center justify-center"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Kelola Petugas</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manajemen tim pemadam kebakaran dan relawan
                    </p>
                </div>
            </div>

            @if (auth()->user()->role === 'admin')
                <button @click="isModalOpen = true"
                    class="bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white px-6 py-2.5 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Tambah Petugas</span>
                </button>
            @endif
        </div>
    </div>
</div>
