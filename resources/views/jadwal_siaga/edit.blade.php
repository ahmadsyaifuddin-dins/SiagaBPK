<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-800 transition-colors duration-300">
        <div class="container mx-auto px-4 py-8">
            <div class="mb-8">
                <div class="flex items-center space-x-3">
                    <div class="bg-amber-500 dark:bg-amber-600 p-3 rounded-xl shadow-lg w-12 h-12 flex items-center justify-center">
                        <i class="fa-solid fa-calendar-check text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-800 dark:text-slate-100">Edit Jadwal Siaga</h1>
                        <p class="text-slate-600 dark:text-slate-400">Perbarui jadwal untuk petugas pemadam kebakaran</p>
                    </div>
                </div>
            </div>

            <div class="max-w-2xl mx-auto">
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <div class="p-8">
                        <form action="{{ route('jadwal_siaga.update', $jadwal_siaga->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            @include('jadwal_siaga._form')

                            <div class="flex items-center justify-between pt-6 border-t border-slate-200 dark:border-slate-700 mt-4">
                                <a href="{{ route('jadwal_siaga.index') }}" 
                                   class="inline-flex items-center px-6 py-3 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-300 font-medium rounded-xl transition-colors duration-200">
                                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                                </a>
                                
                                <button type="submit" 
                                        class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <i class="fa-solid fa-upload mr-2"></i> Update Jadwal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>