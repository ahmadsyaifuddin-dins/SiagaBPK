<div class="mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="p-3 bg-gradient-to-r from-red-500 to-orange-500 rounded-xl shadow-lg">
                <i class="fa-solid fa-fire-flame-curved text-white text-xl w-6 h-6 flex items-center justify-center"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                    Daftar Insiden Kebakaran
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Kelola dan pantau insiden kebakaran dengan mudah</p>
            </div>
        </div>

        <div class="flex gap-3">
            @role('admin')
                <a href="{{ route('insidens.create') }}"
                    class="group relative inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    <i class="fa-solid fa-plus group-hover:rotate-90 transition-transform duration-200"></i>
                    Tambah Insiden
                </a>
                <a href="{{ route('insidens.export.pdf') }}" target="_blank"
                    class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    <i class="fa-solid fa-file-pdf"></i>
                    Export PDF
                </a>
            @endrole
        </div>
    </div>
</div>
