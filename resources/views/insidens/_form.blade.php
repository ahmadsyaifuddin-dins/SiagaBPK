@auth
    <input type="hidden" name="dilaporkan_oleh" value="{{ auth()->id() }}">
    <div
        class="text-sm text-gray-600 dark:text-gray-300 mb-6 bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-100 dark:border-blue-800">
        <i class="fa-solid fa-user-check text-blue-500 mr-2"></i>
        Dilaporkan oleh: <span class="font-bold text-blue-700 dark:text-blue-400">{{ auth()->user()->name }}
            ({{ ucfirst(auth()->user()->role) }})
        </span>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="group">
            <x-forms.label for="nama_pelapor" value="Nama Pelapor (Umum)" required="true">
                <i class="fa-solid fa-user text-blue-500"></i>
            </x-forms.label>
            <x-forms.input type="text" name="nama_pelapor" id="nama_pelapor"
                value="{{ old('nama_pelapor', $insiden->nama_pelapor ?? '') }}" required />
        </div>
        <div class="group">
            <x-forms.label for="kontak_pelapor" value="Kontak Pelapor" required="true">
                <i class="fa-solid fa-phone text-blue-500"></i>
            </x-forms.label>
            <x-forms.input type="text" name="kontak_pelapor" id="kontak_pelapor"
                value="{{ old('kontak_pelapor', $insiden->kontak_pelapor ?? '') }}" required />
        </div>
    </div>
@endauth

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="group">
        <x-forms.label for="lokasi" value="Lokasi Kejadian" required="true">
            <i class="fa-solid fa-location-dot text-red-500"></i>
        </x-forms.label>
        <x-forms.input type="text" name="lokasi" id="lokasi" placeholder="Misal: Jl. Hasan Basri..."
            value="{{ old('lokasi', $insiden->lokasi ?? '') }}" required />
    </div>

    <div class="group">
        <x-forms.label for="waktu_kejadian" value="Waktu Kejadian" required="true">
            <i class="fa-solid fa-clock text-green-500"></i>
        </x-forms.label>
        <x-forms.input type="datetime-local" name="waktu_kejadian" id="waktu_kejadian"
            value="{{ old('waktu_kejadian', isset($insiden) ? date('Y-m-d\TH:i', strtotime($insiden->waktu_kejadian)) : now()->format('Y-m-d\TH:i')) }}"
            required />
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="group">
        <x-forms.label for="jenis_insiden" value="Jenis Insiden">
            <i class="fa-solid fa-fire text-orange-500"></i>
        </x-forms.label>
        <x-forms.input type="text" name="jenis_insiden" id="jenis_insiden" placeholder="Misal: Kebakaran Rumah"
            value="{{ old('jenis_insiden', $insiden->jenis_insiden ?? '') }}" />
    </div>

    <div class="group">
        <x-forms.label for="jumlah_korban" value="Jumlah Korban (Jika Diketahui)">
            <i class="fa-solid fa-users text-gray-500"></i>
        </x-forms.label>
        <x-forms.input type="number" name="jumlah_korban" id="jumlah_korban" placeholder="0" min="0"
            value="{{ old('jumlah_korban', $insiden->jumlah_korban ?? '') }}" />
    </div>
</div>

@if (in_array(auth()->user()->role, ['admin', 'relawan']))
    <div class="bg-gray-50 dark:bg-gray-800/50 p-4 rounded-xl border border-gray-200 dark:border-gray-700 mb-6">
        <h4 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
            <i class="fa-solid fa-shield-halved text-indigo-500 mr-2"></i> Kolom Khusus Petugas
        </h4>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="group">
                <x-forms.label for="kerugian" value="Taksiran Kerugian Material">
                    <i class="fa-solid fa-sack-dollar text-red-500"></i>
                </x-forms.label>
                <x-forms.input-currency name="kerugian" id="kerugian" placeholder="Contoh: 15.000.000"
                    value="{{ old('kerugian', $insiden->kerugian ?? '') }}" />
                <small class="text-xs text-gray-500 mt-1 block">Kosongkan jika tidak ada kerugian material.</small>
            </div>

            <div class="group">
                <x-forms.label for="status" value="Status Laporan" required="true">
                    <i class="fa-solid fa-info-circle text-yellow-500"></i>
                </x-forms.label>
                <x-forms.dropdown name="status" id="status" required>
                    @php $currentStatus = old('status', $insiden->status ?? 'Dilaporkan'); @endphp
                    <option value="Dilaporkan" {{ $currentStatus == 'Dilaporkan' ? 'selected' : '' }}>🔴 Dilaporkan
                    </option>
                    <option value="Berangkat" {{ $currentStatus == 'Berangkat' ? 'selected' : '' }}>🟡 Berangkat
                    </option>
                    <option value="Tiba di TKP" {{ $currentStatus == 'Tiba di TKP' ? 'selected' : '' }}>🔵 Tiba di TKP
                    </option>
                    <option value="Selesai" {{ $currentStatus == 'Selesai' ? 'selected' : '' }}>🟢 Selesai</option>
                </x-forms.dropdown>
            </div>

            <div class="group md:col-span-2 lg:col-span-1">
                <x-forms.label for="petugas" value="Petugas Yang Berangkat">
                    <i class="fa-solid fa-user-shield text-indigo-500"></i>
                </x-forms.label>
                <x-forms.dropdown name="petugas[]" id="petugas" multiple="true" class="h-24">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ in_array($user->id, old('petugas', $petugas_terpilih ?? [])) ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </x-forms.dropdown>
                <small class="text-gray-500 dark:text-gray-400 mt-1 block text-xs">* Tahan Ctrl/Cmd untuk pilih
                    banyak.</small>
            </div>
        </div>
    </div>
@else
@endif

<div class="group mb-6">
    <x-forms.label for="catatan" value="Catatan Tambahan (Opsional)">
        <i class="fa-solid fa-clipboard text-purple-500"></i>
    </x-forms.label>
    <x-forms.textarea name="catatan" id="catatan" rows="3"
        placeholder="Deskripsikan situasi di lapangan...">{{ old('catatan', $insiden->catatan ?? '') }}</x-forms.textarea>
</div>

<div class="group mb-6">
    <x-forms.label value="Foto Dokumentasi (Opsional)">
        <i class="fa-solid fa-camera text-indigo-500"></i>
    </x-forms.label>

    @if (isset($insiden) && $insiden->foto)
        <div class="mb-3">
            <img src="{{ asset($insiden->foto) }}" alt="Foto Insiden"
                class="h-32 object-cover rounded-lg border border-gray-300 shadow-sm">
            <p class="text-xs text-amber-500 mt-2 font-medium"><i class="fa-solid fa-triangle-exclamation"></i> Upload
                file baru jika ingin menimpa foto ini.</p>
        </div>
    @endif

    <x-forms.upload-gambar name="foto" />
</div>
