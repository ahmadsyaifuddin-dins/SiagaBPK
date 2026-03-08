<x-app-layout>
    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl mb-6 border border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('users.index') }}"
                            class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 p-3 rounded-xl transition-colors duration-200 text-gray-600 dark:text-gray-400">
                            <i class="fa-solid fa-arrow-left text-xl"></i>
                        </a>
                        <div class="flex items-center space-x-3">
                            <div class="bg-blue-100 dark:bg-blue-900/30 p-3 rounded-xl text-blue-600 dark:text-blue-400">
                                <i class="fa-solid fa-user-pen text-2xl w-8 h-8 flex items-center justify-center"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Data Petugas</h1>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Kelola data dan hak akses
                                    anggota tim</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl mb-6 border border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div
                                class="h-16 w-16 rounded-full bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center shadow-inner">
                                <span
                                    class="text-white font-bold text-2xl">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $user->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mt-0.5"><i
                                    class="fa-solid fa-envelope mr-1"></i> {{ $user->email }}</p>
                            <div class="mt-2">
                                <span
                                    class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $user->role === 'relawan' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' }}">
                                    <i
                                        class="fa-solid {{ $user->role === 'admin' ? 'fa-user-gear' : 'fa-helmet-safety' }} mr-1.5 mt-0.5"></i>
                                    Role Saat Ini: {{ ucfirst($user->role ?? 'Belum Ada') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-6 md:p-8 space-y-8">

                        <div class="border-b border-gray-200 dark:border-gray-700 pb-8">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                                <i class="fa-solid fa-address-card mr-3 text-blue-500"></i>
                                Informasi Pengguna
                            </h3>

                            @include('users._form', ['hideRole' => true])

                        </div>

                        @php
                            // SUDAH DIBERSIHKAN: Langsung mengambil dari $user->role
                            $currentRole = old('role', $user->role ?? '');
                        @endphp
                        <div x-data="{ selectedRole: '{{ $currentRole }}' }">

                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fa-solid fa-user-shield mr-3 text-red-500"></i>
                                Pengaturan Role
                            </h3>

                            <div
                                class="bg-blue-50 dark:bg-gray-700/50 rounded-xl p-4 mb-6 border border-blue-100 dark:border-gray-600">
                                <div class="flex items-start space-x-3">
                                    <i class="fa-solid fa-circle-info text-blue-500 mt-1 flex-shrink-0 text-lg"></i>
                                    <div>
                                        <p class="text-sm font-bold text-blue-900 dark:text-blue-300">Informasi Role</p>
                                        <p class="text-sm text-blue-700 dark:text-blue-400 mt-1 leading-relaxed">
                                            Role menentukan hak akses dan tanggung jawab pengguna dalam sistem pemadam
                                            kebakaran.
                                            Pastikan untuk memilih role yang sesuai dengan wewenang yang diberikan.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Pilih Role Baru <span class="text-red-500">*</span>
                            </label>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach (['admin', 'relawan'] as $roleOption)
                                    <label
                                        class="relative flex items-center p-4 border-2 rounded-xl cursor-pointer transition-all duration-200"
                                        :class="selectedRole === '{{ $roleOption }}' ?
                                            'border-red-500 bg-red-50 dark:bg-red-900/20 shadow-sm' :
                                            'border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50'">

                                        <input type="radio" name="role" value="{{ $roleOption }}"
                                            class="sr-only" x-model="selectedRole">

                                        <div class="flex items-center justify-between w-full">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0">
                                                    <div class="w-12 h-12 rounded-full flex items-center justify-center transition-colors duration-200"
                                                        :class="selectedRole === '{{ $roleOption }}' ?
                                                            'bg-red-500 shadow-md' : 'bg-gray-200 dark:bg-gray-600'">
                                                        <i class="fa-solid {{ $roleOption === 'admin' ? 'fa-user-gear' : 'fa-helmet-safety' }} text-lg transition-colors duration-200"
                                                            :class="selectedRole === '{{ $roleOption }}' ? 'text-white' :
                                                                'text-gray-500 dark:text-gray-400'"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="text-base font-bold text-gray-900 dark:text-white">
                                                        {{ ucfirst($roleOption) }}</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                                        {{ $roleOption === 'relawan' ? 'Anggota lapangan' : 'Administrator sistem' }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex-shrink-0 ml-4">
                                                <div class="w-6 h-6 border-2 rounded-full flex items-center justify-center transition-all duration-200"
                                                    :class="selectedRole === '{{ $roleOption }}' ?
                                                        'border-red-500 bg-red-500' :
                                                        'border-gray-300 dark:border-gray-600'">
                                                    <i class="fa-solid fa-check text-white text-[11px]"
                                                        x-show="selectedRole === '{{ $roleOption }}'"
                                                        style="display: none;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            @error('role')
                                <p class="text-red-500 dark:text-red-400 text-sm mt-2"><i
                                        class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div
                        class="px-6 py-5 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700 flex flex-col-reverse sm:flex-row justify-between items-center gap-4 sm:gap-0">
                        <a href="{{ route('users.index') }}"
                            class="w-full sm:w-auto text-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200 font-semibold">
                            <i class="fa-solid fa-xmark mr-2"></i> Batal
                        </a>

                        <div class="w-full sm:w-auto flex flex-col sm:flex-row items-center gap-3">
                            <button type="reset"
                                class="w-full sm:w-auto px-6 py-3 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 font-medium">
                                <i class="fa-solid fa-rotate-left mr-1"></i> Reset
                            </button>
                            <button type="submit"
                                class="w-full sm:w-auto bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center">
                                <i class="fa-solid fa-cloud-arrow-up mr-2"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
