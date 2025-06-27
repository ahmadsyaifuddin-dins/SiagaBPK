<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('users.index') }}" class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 p-3 rounded-xl transition-colors duration-200">
                            <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <div class="flex items-center space-x-3">
                            <div class="bg-blue-100 dark:bg-blue-900/30 p-3 rounded-xl">
                                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Data Petugas</h1>
                                <p class="text-gray-600 dark:text-gray-400">Kelola data anggota tim pemadam kebakaran</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Info Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="h-16 w-16 rounded-full bg-gradient-to-r from-red-400 to-orange-400 flex items-center justify-center">
                                <span class="text-white font-bold text-2xl">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                            <div class="mt-2">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                                    {{ $user->hasRole('relawan') ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                    Role Saat Ini: {{ ucfirst($user->getRoleNames()->first() ?? 'Belum Ada Role') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="p-6 space-y-6">
                        <!-- User Information Section -->
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Informasi Pengguna
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nama Lengkap -->
                                <div class="md:col-span-2">
                                    <label class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Nama Lengkap *
                                    </label>
                                    <input type="text" name="name" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white transition-colors duration-200" placeholder="Masukkan nama lengkap" value="{{ $user->name }}" required>
                                </div>
                                
                                <!-- Email -->
                                <div class="md:col-span-2">
                                    <label class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        Email *
                                    </label>
                                    <input type="email" name="email" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white transition-colors duration-200" placeholder="nama@email.com" value="{{ $user->email }}" required>
                                </div>

                                <!-- Password -->
                                <div class="md:col-span-2">
                                    <label class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        Password Baru (Kosongkan jika tidak ingin mengubah)
                                    </label>
                                    <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white transition-colors duration-200" placeholder="Minimal 8 karakter">
                                </div>

                                <!-- Jenis Kelamin -->
                                <div>
                                    <label class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="fas fa-venus-mars mr-2"></i>
                                        Jenis Kelamin *
                                    </label>
                                    <select name="jenis_kelamin" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white transition-colors duration-200" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>

                                <!-- No. HP -->
                                <div>
                                    <label class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        No. HP *
                                    </label>
                                    <input type="text" name="no_hp" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white transition-colors duration-200" placeholder="08xxxxxxxxxx" value="{{ $user->no_hp }}" required>
                                </div>

                                <!-- Tanggal Lahir -->
                                <div>
                                    <label class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Tanggal Lahir
                                    </label>
                                    <input type="date" name="tanggal_lahir" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white transition-colors duration-200" value="{{ $user->tanggal_lahir }}">
                                </div>

                                <!-- Golongan Darah -->
                                <div>
                                    <label class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                        Golongan Darah
                                    </label>
                                    <select name="golongan_darah" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white transition-colors duration-200">
                                        <option value="">Pilih Golongan Darah</option>
                                        <option value="A+" {{ $user->golongan_darah == 'A+' ? 'selected' : '' }}>A+</option>
                                        <option value="A-" {{ $user->golongan_darah == 'A-' ? 'selected' : '' }}>A-</option>
                                        <option value="B+" {{ $user->golongan_darah == 'B+' ? 'selected' : '' }}>B+</option>
                                        <option value="B-" {{ $user->golongan_darah == 'B-' ? 'selected' : '' }}>B-</option>
                                        <option value="AB+" {{ $user->golongan_darah == 'AB+' ? 'selected' : '' }}>AB+</option>
                                        <option value="AB-" {{ $user->golongan_darah == 'AB-' ? 'selected' : '' }}>AB-</option>
                                        <option value="O+" {{ $user->golongan_darah == 'O+' ? 'selected' : '' }}>O+</option>
                                        <option value="O-" {{ $user->golongan_darah == 'O-' ? 'selected' : '' }}>O-</option>
                                    </select>
                                </div>

                                <!-- Jabatan -->
                                <div>
                                    <label class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        Jabatan
                                    </label>
                                    <select name="jabatan" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white transition-colors duration-200">
                                        <option value="">Pilih Jabatan</option>
                                        <option value="Komandan" {{ $user->jabatan == 'Komandan' ? 'selected' : '' }}>Komandan</option>
                                        <option value="Petugas Lapangan" {{ $user->jabatan == 'Petugas Lapangan' ? 'selected' : '' }}>Petugas Lapangan</option>
                                        <option value="Danton" {{ $user->jabatan == 'Danton' ? 'selected' : '' }}>Danton</option>
                                        <option value="Wakil Komandan" {{ $user->jabatan == 'Wakil Komandan' ? 'selected' : '' }}>Wakil Komandan</option>
                                        <option value="Petugas Senior" {{ $user->jabatan == 'Petugas Senior' ? 'selected' : '' }}>Petugas Senior</option>
                                        <option value="Petugas Junior" {{ $user->jabatan == 'Petugas Junior' ? 'selected' : '' }}>Petugas Junior</option>
                                        <option value="Anggota Regu" {{ $user->jabatan == 'Anggota Regu' ? 'selected' : '' }}>Anggota Regu</option>
                                        <option value="Petugas Medis" {{ $user->jabatan == 'Petugas Medis' ? 'selected' : '' }}>Petugas Medis</option>
                                        <option value="Petugas Teknis" {{ $user->jabatan == 'Petugas Teknis' ? 'selected' : '' }}>Petugas Teknis</option>
                                    </select>
                                </div>

                                <!-- Alamat -->
                                <div class="md:col-span-2">
                                    <label class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Alamat
                                    </label>
                                    <textarea name="alamat" rows="3" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white transition-colors duration-200">{{ $user->alamat }}</textarea>
                                </div>

                                <!-- Status Aktif -->
                                <div>
                                    <label class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="fas fa-heartbeat mr-2"></i>
                                        Status Aktif
                                    </label>
                                    <select name="status_aktif" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-white transition-colors duration-200">
                                        <option value="1" {{ $user->status_aktif == 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ $user->status_aktif == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Role Management Section -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Pengaturan Role
                            </h3>
                            
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 mb-4">
                                <div class="flex items-start space-x-3">
                                    <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Informasi Role</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                            Role menentukan hak akses dan tanggung jawab pengguna dalam sistem pemadam kebakaran. 
                                            Pastikan untuk memilih role yang sesuai dengan tugas dan wewenang yang akan diberikan.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    Pilih Role Baru
                                </label>
                                
                                <div class="space-y-3">
                                    @foreach ($roles as $role)
                                    <label class="relative flex items-center p-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl cursor-pointer hover:border-red-300 dark:hover:border-red-500 transition-colors duration-200 {{ $user->hasRole($role) ? 'border-red-500 bg-red-50 dark:bg-red-900/20' : 'hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                        <input type="radio" name="role" value="{{ $role }}" class="sr-only" {{ $user->hasRole($role) ? 'checked' : '' }}>
                                        <div class="flex items-center justify-between w-full">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0">
                                                    <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $user->hasRole($role) ? 'bg-red-500' : 'bg-gray-300 dark:bg-gray-600' }}">
                                                        @if($role === 'relawan')
                                                            <svg class="w-5 h-5 {{ $user->hasRole($role) ? 'text-white' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                            </svg>
                                                        @else
                                                            <svg class="w-5 h-5 {{ $user->hasRole($role) ? 'text-white' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ ucfirst($role) }}</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                                        @if($role === 'relawan')
                                                            Anggota tim pemadam kebakaran
                                                        @else
                                                            {{ ucfirst($role) }} sistem
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="w-5 h-5 border-2 border-gray-300 dark:border-gray-600 rounded-full flex items-center justify-center {{ $user->hasRole($role) ? 'border-red-500 bg-red-500' : '' }}">
                                                    @if($user->hasRole($role))
                                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 flex justify-between items-center">
                        <a href="{{ route('users.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200 font-semibold">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                        
                        <div class="flex items-center space-x-3">
                            <button type="reset" class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200 font-semibold">
                                Reset
                            </button>
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Radio button functionality
        document.querySelectorAll('input[name="role"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // Remove selected styling from all labels
                document.querySelectorAll('label[for^="role"]').forEach(label => {
                    label.classList.remove('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                    label.classList.add('border-gray-200', 'dark:border-gray-600');
                    
                    // Reset circle styling
                    const circle = label.querySelector('.w-5.h-5.border-2');
                    if (circle) {
                        circle.classList.remove('border-red-500', 'bg-red-500');
                        circle.classList.add('border-gray-300', 'dark:border-gray-600');
                        circle.innerHTML = '';
                    }
                    
                    // Reset icon styling
                    const icon = label.querySelector('.w-10.h-10 > svg');
                    if (icon) {
                        icon.classList.remove('text-white');
                        icon.classList.add('text-gray-500');
                    }
                    const iconContainer = label.querySelector('.w-10.h-10');
                    if (iconContainer) {
                        iconContainer.classList.remove('bg-red-500');
                        iconContainer.classList.add('bg-gray-300', 'dark:bg-gray-600');
                    }
                });
                
                // Add selected styling to current label
                const currentLabel = this.closest('label');
                currentLabel.classList.remove('border-gray-200', 'dark:border-gray-600');
                currentLabel.classList.add('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                
                // Update circle styling
                const circle = currentLabel.querySelector('.w-5.h-5.border-2');
                if (circle) {
                    circle.classList.remove('border-gray-300', 'dark:border-gray-600');
                    circle.classList.add('border-red-500', 'bg-red-500');
                    circle.innerHTML = '<svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>';
                }
                
                // Update icon styling
                const icon = currentLabel.querySelector('.w-10.h-10 > svg');
                if (icon) {
                    icon.classList.remove('text-gray-500');
                    icon.classList.add('text-white');
                }
                const iconContainer = currentLabel.querySelector('.w-10.h-10');
                if (iconContainer) {
                    iconContainer.classList.remove('bg-gray-300', 'dark:bg-gray-600');
                    iconContainer.classList.add('bg-red-500');
                }
            });
        });
    </script>
</x-app-layout>