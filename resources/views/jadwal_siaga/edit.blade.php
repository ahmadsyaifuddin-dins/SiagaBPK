{{-- resources/views/jadwal_siaga/edit.blade.php --}}
<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 mb-8 overflow-hidden">
                <div class="bg-gradient-to-r from-red-600 to-orange-600 dark:from-red-700 dark:to-orange-700 px-8 py-6">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/20 p-3 rounded-full">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">✏️ Edit Jadwal Siaga</h1>
                            <p class="text-red-100 mt-1">Perbarui jadwal siaga pemadam kebakaran</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <form action="{{ route('jadwal_siaga.update', $jadwal_siaga->id) }}" method="POST" class="p-8 space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama Relawan -->
                    <div class="space-y-3">
                        <label class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 mr-2 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Nama Relawan
                        </label>
                        <div class="relative">
                            <select name="user_id" 
                                class="w-full pl-12 pr-4 py-4 border border-gray-300 dark:border-gray-600 rounded-xl 
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                       focus:ring-4 focus:ring-red-500/20 focus:border-red-500 dark:focus:border-red-400
                                       transition-all duration-200 appearance-none cursor-pointer
                                       hover:border-red-400 dark:hover:border-red-500" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == $jadwal_siaga->user_id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-red-600 dark:text-red-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal -->
                    <div class="space-y-3">
                        <label class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 mr-2 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Tanggal
                        </label>
                        <div class="relative">
                            <input type="date" name="tanggal" 
                                value="{{ $jadwal_siaga->tanggal }}" 
                                class="w-full pl-12 pr-4 py-4 border border-gray-300 dark:border-gray-600 rounded-xl 
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                       focus:ring-4 focus:ring-red-500/20 focus:border-red-500 dark:focus:border-red-400
                                       transition-all duration-200
                                       hover:border-red-400 dark:hover:border-red-500" required>
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-red-600 dark:text-red-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="space-y-3">
                        <label class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 mr-2 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Status
                        </label>
                        <div class="relative">
                            <select name="status" 
                                class="w-full pl-12 pr-4 py-4 border border-gray-300 dark:border-gray-600 rounded-xl 
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                       focus:ring-4 focus:ring-red-500/20 focus:border-red-500 dark:focus:border-red-400
                                       transition-all duration-200 appearance-none cursor-pointer
                                       hover:border-red-400 dark:hover:border-red-500" required>
                                <option value="Siaga" {{ $jadwal_siaga->status == 'Siaga' ? 'selected' : '' }}>🔥 Siaga</option>
                                <option value="Tugas" {{ $jadwal_siaga->status == 'Tugas' ? 'selected' : '' }}>🚒 Tugas</option>
                                <option value="Istirahat" {{ $jadwal_siaga->status == 'Istirahat' ? 'selected' : '' }}>😴 Istirahat</option>
                            </select>
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-red-600 dark:text-red-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <button type="submit" 
                            class="flex-1 sm:flex-none sm:w-auto inline-flex items-center justify-center px-8 py-4
                                   bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700
                                   dark:from-green-500 dark:to-emerald-500 dark:hover:from-green-600 dark:hover:to-emerald-600
                                   text-white font-semibold rounded-xl shadow-lg hover:shadow-xl
                                   transform hover:-translate-y-0.5 transition-all duration-200
                                   focus:ring-4 focus:ring-green-500/25 focus:outline-none">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Update Jadwal
                        </button>
                        
                        <a href="{{ route('jadwal_siaga.index') }}" 
                           class="flex-1 sm:flex-none sm:w-auto inline-flex items-center justify-center px-8 py-4
                                  bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600
                                  text-gray-700 dark:text-gray-300 font-semibold rounded-xl shadow-lg hover:shadow-xl
                                  transform hover:-translate-y-0.5 transition-all duration-200
                                  focus:ring-4 focus:ring-gray-500/25 focus:outline-none border border-gray-300 dark:border-gray-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>

            <!-- Tips Card -->
            <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 
                        border border-blue-200 dark:border-blue-800 rounded-2xl p-6">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-blue-900 dark:text-blue-100">Tips Penjadwalan</h3>
                        <p class="text-sm text-blue-700 dark:text-blue-300 mt-1">
                            Pastikan untuk mengatur jadwal siaga dengan bijak agar tim pemadam kebakaran selalu siap menghadapi keadaan darurat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>