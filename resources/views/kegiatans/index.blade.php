<x-app-layout>
    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-gradient-to-r from-teal-500 to-emerald-500 rounded-xl shadow-lg">
                        <i
                            class="fa-solid fa-camera-retro text-white text-xl w-6 h-6 flex items-center justify-center"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                            Dokumentasi Kegiatan
                        </h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">Galeri operasional, sosialisasi, dan giat rutin
                            BPK</p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('kegiatans.create') }}"
                        class="group relative inline-flex items-center gap-2 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <i class="fa-solid fa-plus group-hover:rotate-90 transition-transform duration-200"></i>
                        Tambah Kegiatan
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($data as $kegiatan)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col">

                        <div class="relative h-48 bg-gray-200 dark:bg-gray-700 overflow-hidden group">
                            @if ($kegiatan->foto)
                                <img src="{{ asset($kegiatan->foto) }}" alt="{{ $kegiatan->judul_kegiatan }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center opacity-50">
                                    <i class="fa-solid fa-image text-4xl mb-2"></i>
                                    <span class="text-sm font-medium">Tanpa Dokumentasi</span>
                                </div>
                            @endif

                            @php
                                $statusClass = match ($kegiatan->status) {
                                    'Akan Datang' => 'bg-blue-500 text-white',
                                    'Selesai' => 'bg-emerald-500 text-white',
                                    'Batal' => 'bg-red-500 text-white',
                                    default => 'bg-gray-500 text-white',
                                };
                            @endphp
                            <div
                                class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-bold shadow-md {{ $statusClass }}">
                                {{ $kegiatan->status }}
                            </div>
                        </div>

                        <div class="p-5 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">
                                <a href="{{ route('kegiatans.show', $kegiatan->id) }}"
                                    class="hover:text-teal-600 transition-colors">
                                    {{ $kegiatan->judul_kegiatan }}
                                </a>
                            </h3>

                            <div class="space-y-2 mb-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
                                    <i class="fa-regular fa-calendar text-teal-500 w-4 text-center"></i>
                                    {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d M Y - H:i') }}
                                    WITA
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot text-red-500 w-4 text-center"></i>
                                    <span class="truncate">{{ $kegiatan->lokasi }}</span>
                                </p>
                            </div>

                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-3 mb-6 flex-1">
                                {{ $kegiatan->deskripsi }}
                            </p>

                            <div
                                class="pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between mt-auto">
                                <a href="{{ route('kegiatans.show', $kegiatan->id) }}"
                                    class="text-sm font-bold text-teal-600 hover:text-teal-800 dark:text-teal-400 transition-colors">
                                    Baca Selengkapnya <i class="fa-solid fa-arrow-right ml-1"></i>
                                </a>

                                <div class="flex gap-2">
                                    <a href="{{ route('kegiatans.edit', $kegiatan->id) }}"
                                        class="w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 flex items-center justify-center transition-colors"
                                        title="Edit">
                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </a>
                                    <form action="{{ route('kegiatans.destroy', $kegiatan->id) }}" method="POST"
                                        onsubmit="confirmDelete(event, this, 'Yakin menghapus dokumentasi kegiatan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 flex items-center justify-center transition-colors"
                                            title="Hapus">
                                            <i class="fa-solid fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3">
                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-12 text-center flex flex-col items-center">
                            <div
                                class="w-24 h-24 bg-gray-50 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                <i class="fa-solid fa-photo-film text-5xl text-gray-400 dark:text-gray-500"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Belum ada dokumentasi
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-md">Jadikan halaman ini sebagai rekam
                                jejak profesionalisme instansi. Mulai catat kegiatan rutin, latihan, atau sosialisasi
                                pertama Anda.</p>
                            <a href="{{ route('kegiatans.create') }}"
                                class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-xl font-bold transition-all shadow-md">
                                <i class="fa-solid fa-plus"></i> Tambah Kegiatan Baru
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
