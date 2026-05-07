@if ($insiden->catatan)
    <div
        class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div
            class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/20 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center">
                <i class="fa-solid fa-clipboard text-indigo-600 dark:text-indigo-400 mr-2"></i> Catatan Kejadian
            </h3>
        </div>
        <div class="p-6">
            <div class="prose prose-gray dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed">
                {!! nl2br(e($insiden->catatan)) !!}
            </div>
        </div>
    </div>
@endif

@if ($insiden->foto)
    <div
        class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div
            class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center">
                <i class="fa-solid fa-camera text-green-600 dark:text-green-400 mr-2"></i> Dokumentasi Kejadian
            </h3>
        </div>
        <div class="p-6">
            <div class="relative group">
                <img src="{{ asset($insiden->foto) }}" alt="Foto Insiden"
                    class="w-full rounded-xl shadow-lg transition-transform duration-300 group-hover:scale-[1.02]">
            </div>
        </div>
    </div>
@endif
