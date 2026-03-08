<div
    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700">
    <div class="p-6 md:p-8">
        <h3
            class="text-xl font-bold text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-gray-700 pb-4 flex items-center">
            <i class="fa-solid fa-list-ul mr-3 text-orange-500"></i>
            Informasi Lengkap
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="bg-gray-50 dark:bg-gray-700/30 p-6 rounded-2xl border border-gray-100 dark:border-gray-600/50">
                <h4 class="font-bold text-gray-800 dark:text-gray-200 mb-5 flex items-center">
                    <i class="fa-solid fa-user-tag text-red-500 mr-2 text-lg"></i>
                    Data Pribadi
                </h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Jenis
                            Kelamin</p>
                        <p class="font-medium text-gray-900 dark:text-white mt-1">{{ $user->jenis_kelamin ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Tanggal Lahir</p>
                        <p class="font-medium text-gray-900 dark:text-white mt-1">
                            {{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Golongan Darah</p>
                        <p class="font-medium text-gray-900 dark:text-white mt-1">
                            @if ($user->golongan_darah)
                                <span
                                    class="inline-flex items-center justify-center bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-400 font-bold px-3 py-1 rounded-lg">
                                    {{ $user->golongan_darah }}
                                </span>
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700/30 p-6 rounded-2xl border border-gray-100 dark:border-gray-600/50">
                <h4 class="font-bold text-gray-800 dark:text-gray-200 mb-5 flex items-center">
                    <i class="fa-solid fa-briefcase text-blue-500 mr-2 text-lg"></i>
                    Data Profesional
                </h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Jabatan</p>
                        <p class="font-medium text-gray-900 dark:text-white mt-1">{{ $user->jabatan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Bergabung Pada</p>
                        <p class="font-medium text-gray-900 dark:text-white mt-1">
                            {{ $user->created_at->translatedFormat('d F Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Terakhir Diperbarui</p>
                        <p class="font-medium text-gray-900 dark:text-white mt-1">
                            {{ $user->updated_at->translatedFormat('d F Y, H:i') }} WITA</p>
                    </div>
                </div>
            </div>

            <div
                class="md:col-span-2 bg-gray-50 dark:bg-gray-700/30 p-6 rounded-2xl border border-gray-100 dark:border-gray-600/50">
                <h4 class="font-bold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                    <i class="fa-solid fa-map-location-dot text-green-500 mr-2 text-lg"></i>
                    Alamat Lengkap
                </h4>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    {{ $user->alamat ?? 'Belum ada alamat yang dicantumkan.' }}
                </p>
            </div>
        </div>

        <div
            class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
            <a href="{{ route('users.index') }}"
                class="text-center px-6 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-xl font-medium transition-colors duration-200">
                Kembali ke Daftar
            </a>

            @if (auth()->user()->role === 'admin')
                <a href="{{ route('users.edit', $user->id) }}"
                    class="sm:hidden text-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold shadow-md transition-colors duration-200 flex justify-center items-center gap-2">
                    <i class="fa-solid fa-user-pen"></i> Edit Profil
                </a>
            @endif
        </div>
    </div>
</div>
