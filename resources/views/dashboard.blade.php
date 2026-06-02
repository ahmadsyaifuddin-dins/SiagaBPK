<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100 leading-tight flex items-center">
                <div class="bg-gradient-to-br from-red-500 to-orange-500 text-white p-2.5 rounded-xl mr-3 shadow-md">
                    <i class="fa-solid fa-chart-pie text-xl w-6 h-6 flex items-center justify-center"></i>
                </div>
                {{ __('Dashboard E-Fire Management') }}
            </h2>

            <div
                class="flex items-center space-x-2 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 px-4 py-2.5 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <i class="fa-regular fa-clock text-blue-500 animate-pulse"></i>
                <span>{{ now()->translatedFormat('l, d M Y | H:i') }} WITA</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div x-data="{
                isModalOpen: false,
                modalImageSrc: '',
                modalImageAlt: '',
                openModal(src, alt) {
                    this.modalImageSrc = src;
                    this.modalImageAlt = alt;
                    this.isModalOpen = true;
                    document.body.classList.add('overflow-hidden');
                },
                closeModal() {
                    this.isModalOpen = false;
                    document.body.classList.remove('overflow-hidden');
                }
            }" @keydown.escape.window="closeModal()"
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 md:p-8 relative">

                <div class="flex flex-col md:flex-row items-center gap-10">
                    <div class="flex-1 text-left">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 text-sm font-semibold mb-4 border border-indigo-200 dark:border-indigo-800/50">
                            <i class="fa-solid fa-location-dot"></i> Profil Posko BPK
                        </div>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-4">Markas KTC Fire
                            Banjarmasin</h2>
                        <p class="text-sm md:text-base text-gray-600 dark:text-gray-400 leading-relaxed mb-6">
                            Pusat komando digital operasional Barisan Pemadam Kebakaran KTC Fire. Gunakan sistem ini
                            dengan bijak untuk memastikan seluruh inventaris siap pakai dan respons personel tetap
                            tanggap dalam menghadapi insiden darurat.
                        </p>
                        <div
                            class="flex items-center gap-3 text-xs text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-900/50 p-3 rounded-lg border border-gray-100 dark:border-gray-700">
                            <i class="fa-solid fa-magnifying-glass-plus text-indigo-500 text-lg"></i>
                            <p>Arahkan kursor ke gambar untuk melihat detail, dan <b>klik</b> untuk memperbesar
                                tampilan.</p>
                        </div>
                    </div>

                    <div class="flex-1 w-full relative group h-[280px] md:h-[320px] flex items-center justify-center">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-red-500/20 to-orange-500/20 blur-2xl rounded-full scale-50 opacity-0 group-hover:opacity-100 group-hover:scale-110 transition-all duration-700 pointer-events-none">
                        </div>

                        @php $imgClass = "absolute rounded-xl shadow-lg object-cover border-4 border-white dark:border-gray-700 aspect-[4/3] cursor-pointer transition-all duration-500 ease-out transform hover:scale-110 hover:z-30 hover:shadow-2xl"; @endphp

                        <img src="{{ asset('tempat/bpk-fire-1.jpg') }}" alt="Tampak Depan Posko BPK KTC"
                            class="{{ $imgClass }} z-0 w-3/4 scale-90 opacity-0 group-hover:opacity-100 group-hover:-translate-x-16 group-hover:-translate-y-16 group-hover:rotate-[-6deg]"
                            @click="openModal($el.src, $el.alt)">

                        <img src="{{ asset('tempat/bpk-fire-2.jpg') }}" alt="Aktivitas Personel & Perlengkapan"
                            class="{{ $imgClass }} z-0 w-3/4 scale-90 opacity-0 group-hover:opacity-100 group-hover:translate-x-16 group-hover:translate-y-16 group-hover:rotate-[6deg]"
                            @click="openModal($el.src, $el.alt)">

                        <img src="{{ asset('tempat/bpk-fire-3.jpg') }}" alt="Armada BPK KTC Fire Banjarmasin"
                            class="{{ $imgClass }} relative z-10 w-3/4 group-hover:scale-105 group-hover:border-indigo-500 dark:group-hover:border-indigo-400"
                            @click="openModal($el.src, $el.alt)">
                    </div>
                </div>

                <div class="fixed inset-0 z-[100] flex items-center justify-center overflow-hidden bg-gray-900/90 backdrop-blur-sm p-4 md:p-10"
                    x-show="isModalOpen" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" @click.self="closeModal()" style="display: none;">
                    <button
                        class="absolute top-5 right-5 text-white/70 hover:text-white text-4xl z-[110] transition-colors"
                        @click="closeModal()" title="Tutup (Esc)">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </button>

                    <div class="relative max-w-5xl max-h-full" x-show="isModalOpen"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="scale-90" x-transition:enter-end="scale-100">
                        <img :src="modalImageSrc" :alt="modalImageAlt"
                            class="rounded-xl shadow-2xl border-2 border-gray-700 max-h-[85vh] w-auto object-contain">
                        <div
                            class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/90 to-transparent p-4 rounded-b-xl">
                            <p class="text-white text-center font-medium" x-text="modalImageAlt"></p>
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.partials.stats')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    @include('dashboard.partials.recent-incidents')
                </div>

                <div>
                    @if (isset($totalNotif) && $totalNotif > 0)
                        <div
                            class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-2xl p-4 flex items-start gap-3 shadow-sm animate-pulse mb-6">
                            <div class="mt-0.5 text-red-500 dark:text-red-400">
                                <i class="fa-solid fa-triangle-exclamation text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-red-800 dark:text-red-400">Perhatian! Ada
                                    {{ $totalNotif }} Item Kritis</h4>
                                <p class="text-xs text-red-600 dark:text-red-300 mt-1 leading-relaxed">
                                    @if ($stokMenipisCount > 0)
                                        <b>{{ $stokMenipisCount }} item</b> stok menipis.<br>
                                    @endif
                                    @if ($kadaluarsaCount > 0)
                                        <b>{{ $kadaluarsaCount }} item</b> mendekati kadaluarsa.
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endif

                    @include('dashboard.partials.inventaris-kritis')
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    @include('dashboard.partials.quick-actions')
                </div>

                <div>
                    @include('dashboard.partials.system-status')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
