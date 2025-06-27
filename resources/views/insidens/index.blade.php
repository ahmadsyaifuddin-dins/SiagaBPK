<x-app-layout>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 transition-colors duration-300">
      <div class="p-6 max-w-7xl mx-auto">
          <!-- Header Section -->
          <div class="mb-8">
              <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                  <div class="flex items-center gap-3">
                      <div class="p-3 bg-gradient-to-r from-red-500 to-orange-500 rounded-xl shadow-lg">
                          <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                          </svg>
                      </div>
                      <div>
                          <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                              Daftar Insiden Kebakaran
                          </h1>
                          <p class="text-gray-600 dark:text-gray-400 mt-1">Kelola dan pantau insiden kebakaran dengan mudah</p>
                      </div>
                  </div>
                  
                  <!-- Action Buttons -->
                  <div class="flex gap-3">
                      <a href="{{ route('insidens.create') }}" 
                         class="group relative inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                          <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                          </svg>
                          Tambah Insiden
                      </a>
                      <a href="{{ route('insidens.export.pdf') }}" target="_blank" 
                         class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                          </svg>
                          Export PDF
                      </a>
                  </div>
              </div>
          </div>

          <!-- Stats Cards (Optional) -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
              <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-shadow duration-300">
                  <div class="flex items-center justify-between">
                      <div>
                          <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Insiden</p>
                          <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $data->count() }}</p>
                      </div>
                      <div class="p-3 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-xl">
                        <i class="fa-solid fa-house-fire"></i>
                      </div>
                  </div>
              </div>
              
              <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-shadow duration-300">
                  <div class="flex items-center justify-between">
                      <div>
                          <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Terlapor</p>
                          <p class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $data->where('status', 'Dilaporkan')->count() }}</p>
                      </div>
                      <div class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-xl">
                          <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                          </svg>
                      </div>
                  </div>
              </div>
              
              <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-shadow duration-300">
                  <div class="flex items-center justify-between">
                      <div>
                          <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Selesai</p>
                          <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $data->where('status', 'Selesai')->count() }}</p>
                      </div>
                      <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-xl">
                          <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                          </svg>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Data Table -->
          <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
              <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Data Insiden Kebakaran</h3>
                  <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Daftar lengkap semua insiden yang tercatat</p>
              </div>
              
              <div class="overflow-x-auto">
                  <table class="w-full">
                      <thead class="bg-gray-50 dark:bg-gray-900/50">
                          <tr>
                              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                  <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot"></i>
                                      Lokasi
                                  </div>
                              </th>
                              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                  <div class="flex items-center gap-2">
                                      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                      </svg>
                                      Waktu Kejadian
                                  </div>
                              </th>
                              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                  <div class="flex items-center gap-2">
                                      <i class="fa-solid fa-circle"></i>
                                      Status
                                  </div>
                              </th>
                              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                  <div class="flex items-center gap-2">
                                      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                          <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                      </svg>
                                      Foto Dokumentasi
                                  </div>
                              </th>
                              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                                  <div class="flex items-center gap-2">
                                      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                          <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                      </svg>
                                      Aksi
                                  </div>
                              </th>
                          </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                          @forelse ($data as $insiden)
                              <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                  <td class="px-6 py-4 whitespace-nowrap">
                                      <div class="flex items-center">
                                          <div class="flex-shrink-0 h-10 w-10">
                                              <div class="h-10 w-10 rounded-full bg-gradient-to-r from-red-400 to-red-600 flex items-center justify-center">
                                                <i class="fa-solid fa-map-location-dot text-white"></i>
                                              </div>
                                          </div>
                                          <div class="ml-4">
                                              <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $insiden->lokasi }}</div>
                                          </div>
                                      </div>
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                      <div class="text-sm text-gray-900 dark:text-gray-100">
                                          {{ \Carbon\Carbon::parse($insiden->waktu_kejadian)->format('d M Y') }}
                                      </div>
                                      <div class="text-sm text-gray-500 dark:text-gray-400">
                                          {{ \Carbon\Carbon::parse($insiden->waktu_kejadian)->format('H:i') }}
                                      </div>
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                      @php
                                          $statusColors = [
                                              'Dilaporkan' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                              'Berangkat' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                              'Tiba di TKP' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                              'Selesai' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                          ];
                                          $colorClass = $statusColors[$insiden->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400';
                                      @endphp
                                      <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $colorClass }}">
                                          {{ $insiden->status }}
                                      </span>
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                      @if ($insiden->foto)
                                          <a href="{{ asset('storage/' . $insiden->foto) }}" 
                                             target="_blank" 
                                             class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-150">
                                              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                              </svg>
                                              Lihat Foto
                                          </a>
                                      @else
                                          <span class="text-gray-400 dark:text-gray-500 text-sm">Tidak ada foto</span>
                                      @endif
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                      <div class="flex items-center gap-3">
                                          <a href="{{ route('insidens.edit', $insiden->id) }}" 
                                             class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-150">
                                              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                  <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                              </svg>
                                              Edit
                                          </a>
                                          <form action="{{ route('insidens.destroy', $insiden->id) }}" method="POST" class="inline">
                                              @csrf @method('DELETE')
                                              <button type="submit" 
                                                      onclick="return confirm('Apakah Anda yakin ingin menghapus insiden ini?')" 
                                                      class="inline-flex items-center gap-1 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-150">
                                                      <i class="fa-solid fa-trash"></i>
                                                  Hapus
                                              </button>
                                          </form>
                                          <a href="{{ route('insidens.show', $insiden->id) }}" 
                                             class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-150">
                                              <i class="fa-solid fa-eye"></i>
                                              Lihat
                                          </a>
                                      </div>
                                  </td>
                              </tr>
                          @empty
                              <tr>
                                  <td colspan="5" class="px-6 py-12 text-center">
                                      <div class="flex flex-col items-center justify-center">
                                          <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                              <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 6a2 2 0 104 0 2 2 0 00-4 0zm6 0a2 2 0 104 0 2 2 0 00-4 0z" clip-rule="evenodd"/>
                                              </svg>
                                          </div>
                                          <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Belum ada data insiden</h3>
                                          <p class="text-gray-500 dark:text-gray-400 mb-6">Mulai dengan menambahkan insiden kebakaran pertama Anda.</p>
                                          <a href="{{ route('insidens.create') }}" 
                                             class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-150">
                                              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                                              </svg>
                                              Tambah Insiden Pertama
                                          </a>
                                      </div>
                                  </td>
                              </tr>
                          @endforelse
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>

  <script>
      // Dark mode detection
      if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
          document.documentElement.classList.add('dark')
      } else {
          document.documentElement.classList.remove('dark')
      }
  </script>
</x-app-layout>