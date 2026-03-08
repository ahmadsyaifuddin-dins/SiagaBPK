<div x-show="isModalOpen" style="display: none;"
    class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 overflow-y-auto"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.self="isModalOpen = false"
    @keydown.escape.window="isModalOpen = false">

    <div x-show="isModalOpen"
        class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

        <div
            class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between bg-gray-50 dark:bg-gray-800">
            <div class="flex items-center gap-3">
                <div class="bg-red-100 dark:bg-red-900/30 p-2 rounded-lg text-red-600 dark:text-red-400">
                    <i class="fa-solid fa-address-card text-lg w-5 h-5 flex items-center justify-center"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Tambah Petugas Baru</h2>
            </div>
            <button @click="isModalOpen = false" type="button"
                class="text-gray-400 hover:text-red-500 dark:hover:text-red-400 transition-colors p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <div class="p-6 overflow-y-auto custom-scrollbar">
            @if ($errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 p-4 rounded-r-lg">
                    <div class="flex items-center text-red-800 dark:text-red-300 mb-2">
                        <i class="fa-solid fa-circle-exclamation mr-2"></i>
                        <span class="font-bold">Gagal menyimpan data!</span>
                    </div>
                    <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST" id="formCreateUser">
                @csrf

                @include('users._form')

            </form>
        </div>

        <div
            class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 flex justify-end gap-3">
            <button @click="isModalOpen = false" type="button"
                class="px-5 py-2.5 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-xl font-medium transition-colors border border-gray-300 dark:border-gray-600 shadow-sm">
                Batal
            </button>
            <button type="submit" form="formCreateUser"
                class="px-6 py-2.5 text-white bg-red-600 hover:bg-red-700 rounded-xl font-medium transition-colors shadow-lg hover:shadow-xl flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Petugas
            </button>
        </div>
    </div>
</div>
