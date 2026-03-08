<x-app-layout>
    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <a href="{{ route('kegiatans.index') }}"
                    class="inline-flex items-center text-gray-500 hover:text-teal-600 font-medium transition-colors">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Galeri
                </a>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl overflow-hidden border border-gray-100 dark:border-gray-700">
                @if ($kegiatan->foto)
                    <div class="w-full h-64 md:h-96 relative">
                        <img src="{{ asset($kegiatan->foto) }}" alt="{{ $kegiatan->judul_kegiatan }}"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    </div>
                @endif

                <div class="p-6 md:p-10 {{ $kegiatan->foto ? '-mt-16 relative z-10' : '' }}">

                    @if ($kegiatan->foto)
                        <div class="flex flex-wrap gap-2 mb-4">
                            @php
                                $statusClass = match ($kegiatan->status) {
                                    'Akan Datang' => 'bg-blue-500',
                                    'Selesai' => 'bg-emerald-500',
                                    'Batal' => 'bg-red-500',
                                    default => 'bg-gray-500',
                                };
                            @endphp
                            <span
                                class="px-4 py-1.5 rounded-full text-sm font-bold shadow-md text-white {{ $statusClass }}">
                                {{ $kegiatan->status }}
                            </span>
                            <span class="px-4 py-1.5 rounded-full text-sm font-bold shadow-md bg-white text-gray-800">
                                <i class="fa-regular fa-calendar mr-1"></i>
                                {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d M Y') }}
                            </span>
                        </div>
                    @endif

                    <h1
                        class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white leading-tight mb-6 {{ !$kegiatan->foto ? 'mt-4' : '' }}">
                        {{ $kegiatan->judul_kegiatan }}
                    </h1>

                    @if (!$kegiatan->foto)
                        <div class="flex flex-wrap gap-3 mb-6 pb-6 border-b border-gray-100">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800">
                                Status: {{ $kegiatan->status }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800">
                                Waktu:
                                {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d M Y - H:i') }}
                            </span>
                        </div>
                    @endif

                    <div
                        class="bg-gray-50 dark:bg-gray-900/50 rounded-2xl p-6 mb-8 border border-gray-100 dark:border-gray-700 flex flex-col md:flex-row md:items-center gap-6">
                        <div class="flex-1">
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Lokasi Pelaksanaan
                            </p>
                            <p class="text-gray-900 dark:text-gray-100 font-medium flex items-center gap-2">
                                <i class="fa-solid fa-location-dot text-red-500"></i> {{ $kegiatan->lokasi }}
                            </p>
                        </div>
                        <div class="hidden md:block w-px h-12 bg-gray-200 dark:bg-gray-700"></div>
                        <div class="flex-1">
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Pukul (WITA)</p>
                            <p class="text-gray-900 dark:text-gray-100 font-medium flex items-center gap-2">
                                <i class="fa-regular fa-clock text-blue-500"></i>
                                {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('H:i') }}
                            </p>
                        </div>
                    </div>

                    <div class="prose prose-lg dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
                        {!! nl2br(e($kegiatan->deskripsi)) !!}
                    </div>

                    <div
                        class="mt-10 pt-6 border-t border-gray-100 dark:border-gray-700 flex items-center justify-end gap-3">
                        <a href="{{ route('kegiatans.edit', $kegiatan->id) }}"
                            class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl font-semibold transition-colors">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('kegiatans.destroy', $kegiatan->id) }}" method="POST"
                            onsubmit="confirmDelete(event, this, 'Yakin menghapus dokumentasi ini?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-xl font-semibold transition-colors">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
