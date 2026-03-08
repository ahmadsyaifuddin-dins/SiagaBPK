<x-app-layout>
    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex items-center gap-4">
                    <a href="{{ route('kegiatans.index') }}"
                        class="w-10 h-10 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 rounded-full flex items-center justify-center transition-colors">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Tambah Dokumentasi Kegiatan</h2>
                </div>

                <form action="{{ route('kegiatans.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    @include('kegiatans._form')
                    <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-4">
                        <a href="{{ route('kegiatans.index') }}"
                            class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-colors">Batal</a>
                        <button type="submit"
                            class="px-6 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg transition-all">
                            <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Kegiatan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
