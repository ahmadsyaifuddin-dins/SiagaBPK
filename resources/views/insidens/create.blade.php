<x-app-layout>
    <x-slot name="header">
        Tambah Laporan Insiden
    </x-slot>

    <div
        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-plus-circle"></i> Form Tambah Insiden Baru
            </h2>
        </div>

        <form action="{{ route('insidens.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            @include('insidens._form')

            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700 mt-6">
                <a href="{{ route('insidens.index') }}"
                    class="px-6 py-2.5 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg font-medium transition-colors">
                    <i class="fa-solid fa-xmark mr-1"></i> Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition-colors">
                    <i class="fa-solid fa-save mr-1"></i> Simpan Laporan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
