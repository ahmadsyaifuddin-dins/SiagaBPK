<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div
        class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Insiden</p>
                <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $data->count() }}</p>
            </div>
            <div
                class="p-3 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-xl flex items-center justify-center w-12 h-12">
                <i class="fa-solid fa-house-fire text-xl"></i>
            </div>
        </div>
    </div>

    <div
        class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Terlapor</p>
                <p class="text-2xl font-bold text-orange-600 dark:text-orange-400">
                    {{ $data->where('status', 'Dilaporkan')->count() }}</p>
            </div>
            <div
                class="p-3 bg-orange-100 dark:bg-orange-900/30 text-orange-600 rounded-xl flex items-center justify-center w-12 h-12">
                <i class="fa-solid fa-bell text-xl"></i>
            </div>
        </div>
    </div>

    <div
        class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Selesai</p>
                <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                    {{ $data->where('status', 'Selesai')->count() }}</p>
            </div>
            <div
                class="p-3 bg-green-100 dark:bg-green-900/30 text-green-600 rounded-xl flex items-center justify-center w-12 h-12">
                <i class="fa-solid fa-circle-check text-xl"></i>
            </div>
        </div>
    </div>
</div>
