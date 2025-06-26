{{-- resources/views/jadwal_siaga/create.blade.php --}}
<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-800 transition-colors duration-300">
        <div class="container mx-auto px-4 py-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center space-x-3">
                    <div class="bg-red-500 dark:bg-red-600 p-3 rounded-xl shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-800 dark:text-slate-100">Tambah Jadwal Siaga</h1>
                        <p class="text-slate-600 dark:text-slate-400">Buat jadwal baru untuk petugas pemadam kebakaran</p>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="max-w-2xl mx-auto">
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <div class="p-8">
                        <form action="{{ route('jadwal_siaga.store') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <!-- User Selection -->
                            <div class="space-y-2">
                                <label for="user_id" class="flex items-center space-x-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Nama Petugas</span>
                                </label>
                                <div class="relative">
                                    <select name="user_id" id="user_id" 
                                            class="w-full px-4 py-3 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-xl text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:border-transparent transition-all duration-200 appearance-none">
                                        <option value="">Pilih Petugas</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                                @error('user_id')
                                    <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date Selection -->
                            <div class="space-y-2">
                                <label for="tanggal" class="flex items-center space-x-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Tanggal Siaga</span>
                                </label>
                                <div class="relative">
                                    <input type="date" name="tanggal" id="tanggal" 
                                           class="w-full px-4 py-3 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-xl text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:border-transparent transition-all duration-200" 
                                           required>
                                </div>
                                @error('tanggal')
                                    <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status Selection -->
                            <div class="space-y-2">
                                <label for="status" class="flex items-center space-x-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 1.414L10.586 9.5H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Status Petugas</span>
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <label class="relative">
                                        <input type="radio" name="status" value="Siaga" class="sr-only peer" checked>
                                        <div class="p-4 bg-white dark:bg-slate-700 border-2 border-amber-200 dark:border-amber-600 peer-checked:border-amber-500 peer-checked:bg-amber-50 dark:peer-checked:bg-amber-900/20 rounded-xl cursor-pointer transition-all duration-200">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Siaga</span>
                                            </div>
                                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Standby siap tugas</p>
                                        </div>
                                    </label>
                                    
                                    <label class="relative">
                                        <input type="radio" name="status" value="Tugas" class="sr-only peer">
                                        <div class="p-4 bg-white dark:bg-slate-700 border-2 border-red-200 dark:border-red-600 peer-checked:border-red-500 peer-checked:bg-red-50 dark:peer-checked:bg-red-900/20 rounded-xl cursor-pointer transition-all duration-200">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Tugas</span>
                                            </div>
                                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Sedang bertugas</p>
                                        </div>
                                    </label>
                                    
                                    <label class="relative">
                                        <input type="radio" name="status" value="Istirahat" class="sr-only peer">
                                        <div class="p-4 bg-white dark:bg-slate-700 border-2 border-green-200 dark:border-green-600 peer-checked:border-green-500 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/20 rounded-xl cursor-pointer transition-all duration-200">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Istirahat</span>
                                            </div>
                                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Waktu istirahat</p>
                                        </div>
                                    </label>
                                </div>
                                @error('status')
                                    <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between pt-6 border-t border-slate-200 dark:border-slate-700">
                                <a href="{{ route('jadwal_siaga.index') }}" 
                                   class="inline-flex items-center px-6 py-3 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-300 font-medium rounded-xl transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Kembali
                                </a>
                                
                                <button type="submit" 
                                        class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Jadwal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles for Radio Buttons -->
    <style>
        input[type="radio"]:checked + div {
            transform: scale(1.02);
        }
    </style>
</x-app-layout>