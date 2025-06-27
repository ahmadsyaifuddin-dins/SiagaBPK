<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-4xl mx-auto p-6">
            <!-- Flash Messages -->
            @if (session('success'))
            <div class="mb-6 bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg shadow-sm animate-pulse"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            @if (session('error'))
            <div class="mb-6 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg shadow-sm"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            </div>
            @endif

            <!-- Main Card -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <!-- Header -->
                <div
                    class="bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-700 dark:to-purple-700 px-6 py-4">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-2 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white">Tambah Laporan Insiden</h2>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('insidens.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-6 space-y-6">
                    @csrf

                    <!-- Pelapor -->
                    @auth
                    <input type="hidden" name="dilaporkan_oleh" value="{{ auth()->id() }}">
                    <div class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                        Dilaporkan oleh: <span class="font-semibold">{{ auth()->user()->name }}</span>
                    </div>
                    @else
                    <div class="group mb-4">
                        <label for="nama_pelapor"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 15c3.866 0 7.35 1.568 9.879 4.096M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Nama Pelapor (Umum)
                            </span>
                        </label>
                        <input type="text" name="nama_pelapor" id="nama_pelapor" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                  bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                  focus:ring-2 focus:ring-blue-500 focus:border-transparent
                  transition-all duration-200 hover:border-blue-300" required>
                    </div>

                    <div class="group mb-4">
                        <label for="kontak_pelapor"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5h2l2 10h8l2-10h2M16 17a4 4 0 11-8 0" />
                                </svg>
                                Kontak Pelapor
                            </span>
                        </label>
                        <input type="text" name="kontak_pelapor" id="kontak_pelapor" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                  bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                  focus:ring-2 focus:ring-blue-500 focus:border-transparent
                  transition-all duration-200 hover:border-blue-300" required>
                    </div>
                    @endauth

                    <!-- Lokasi -->
                    <div class="group">
                        <label for="lokasi" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Lokasi Kejadian <span class="text-red-500 px-1">*</span>
                            </span>
                        </label>
                        <input type="text" name="lokasi" id="lokasi" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                      transition-all duration-200 hover:border-blue-300
                                      placeholder-gray-400 dark:placeholder-gray-500"
                            placeholder="Masukkan lokasi kejadian..." required>
                    </div>

                    <!-- Waktu Kejadian -->
                    <div class="group">
                        <label for="waktu_kejadian"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Waktu Kejadian <span class="text-red-500 px-1">*</span>
                            </span>
                        </label>
                        <input type="text" name="waktu_kejadian" id="waktu_kejadian" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-green-500 focus:border-transparent
                                      transition-all duration-200 hover:border-green-300" required>
                    </div>

                    <!-- Jenis Insiden -->
                    <div class="group">
                        <label for="jenis_insiden"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center">
                                <i class="fa-solid fa-fire mr-2 text-orange-500"></i>
                                Jenis Insiden
                            </span>
                        </label>
                        <input type="text" name="jenis_insiden" id="jenis_insiden" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-green-500 focus:border-transparent
                                      transition-all duration-200 hover:border-green-300"
                            placeholder="Misal: Kebakaran Rumah, Kebakaran Toko, Bengkel, Kantor, Sekolah, dll"
                            required>
                    </div>

                    <!-- Jumlah Korban -->
                    <div class="group">
                        <label for="jumlah_korban"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center">
                                <i class="fa-solid fa-users mr-2 text-grey-800"></i>
                                Jumlah Korban
                            </span>
                        </label>
                        <input type="number" name="jumlah_korban" id="jumlah_korban" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-green-500 focus:border-transparent
                                      transition-all duration-200 hover:border-green-300" placeholder="Misal: 1"
                            required>
                    </div>

                    <!-- Kerugian -->
                    <div class="group">
                        <label for="kerugian" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center">
                                <i class="fa-solid fa-money-bill mr-2 text-green-500"></i>
                                Kerugian
                            </span>
                        </label>
                        <input type="text" name="kerugian" id="kerugian" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-green-500 focus:border-transparent
                                      transition-all duration-200 hover:border-green-300"
                            placeholder="Misal: -+ 50 Juta" required>
                    </div>

                    <!-- Pilih Petugas -->
                    <div class="group">
                        <label for="petugas" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center">
                                <i class="fa-solid fa-user-shield mr-2 text-red-500"></i>
                                Petugas Bertugas <span class="text-red-500 px-1">*</span>
                            </span>
                        </label>
                        <select name="petugas[]" id="petugas" multiple
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 hover:border-red-300">
                            @foreach($users as $user)
                                @if($user->role === 'relawan')
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <small class="text-gray-500 dark:text-gray-400">* Tekan Ctrl (Windows) atau Cmd (Mac) untuk
                            pilih lebih dari satu.</small>
                    </div>


                    <!-- Status -->
                    <div class="group">
                        <label for="status" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-yellow-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Status Laporan <span class="text-red-500 px-1">*</span>
                            </span>
                        </label>
                        <select name="status" id="status" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                       focus:ring-2 focus:ring-yellow-500 focus:border-transparent
                                       transition-all duration-200 hover:border-yellow-300">
                            <option value="Dilaporkan">🔴 Dilaporkan</option>
                            <option value="Berangkat">🟡 Berangkat</option>
                            <option value="Tiba di TKP">🔵 Tiba di TKP</option>
                            <option value="Selesai">🟢 Selesai</option>
                        </select>
                    </div>

                    <!-- Catatan -->
                    <div class="group">
                        <label for="catatan" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Catatan (Opsional)
                            </span>
                        </label>
                        <textarea name="catatan" id="catatan" rows="4" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                         bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                         focus:ring-2 focus:ring-purple-500 focus:border-transparent
                                         transition-all duration-200 hover:border-purple-300
                                         placeholder-gray-400 dark:placeholder-gray-500 resize-none"
                            placeholder="Tambahkan catatan detail tentang insiden... misal: Api berasal dari dapur, cepat ditangani"></textarea>
                    </div>

                    <!-- Upload Foto -->
                    <div class="group">
                        <label for="foto" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Foto Dokumentasi (Opsional)
                            </span>
                        </label>
                        <div
                            class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-indigo-400 dark:hover:border-indigo-500 transition-colors duration-200">
                            <input type="file" name="foto" id="foto" accept="image/*" class="hidden"
                                onchange="previewImage(this)">
                            <label for="foto" class="cursor-pointer">
                                <div class="text-gray-400 dark:text-gray-500 mb-2">
                                    {{-- <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg> --}}
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-semibold text-indigo-600 dark:text-indigo-400">Klik untuk
                                        upload</span> atau drag and drop
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">PNG, JPG, JPEG hingga 2MB</p>
                            </label>
                            <div id="imagePreview" class="mt-4 hidden">
                                <img id="preview" src="" alt="Preview"
                                    class="max-w-full h-32 object-cover rounded-lg mx-auto">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <button type="button" onclick="history.back()" class="px-6 py-3 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 
                                       hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg font-medium 
                                       transition-all duration-200 border border-gray-300 dark:border-gray-600">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Batal
                            </span>
                        </button>
                        <button type="submit" class="px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 
                                       hover:from-green-700 hover:to-green-800 text-white font-semibold 
                                       rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 
                                       transition-all duration-200 focus:ring-4 focus:ring-green-300">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Laporan
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Auto-hide flash messages after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</x-app-layout>