@auth
    <input type="hidden" name="dilaporkan_oleh" value="{{ auth()->id() }}">
    <div
        class="text-sm text-gray-600 dark:text-gray-300 mb-6 bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-100 dark:border-blue-800">
        <i class="fa-solid fa-user-check text-blue-500 mr-2"></i>
        Dilaporkan oleh: <span class="font-bold text-blue-700 dark:text-blue-400">{{ auth()->user()->name }}</span>
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
            value="{{ old('waktu_kejadian', isset($insiden) ? date('Y-m-d\TH:i', strtotime($insiden->waktu_kejadian)) : '') }}"
            required />
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="group">
        <x-forms.label for="jenis_insiden" value="Jenis Insiden">
            <i class="fa-solid fa-fire text-orange-500"></i>
        </x-forms.label>
        <x-forms.input type="text" name="jenis_insiden" id="jenis_insiden" placeholder="Misal: Kebakaran Rumah"
            value="{{ old('jenis_insiden', $insiden->jenis_insiden ?? '') }}" />
    </div>

    <div class="group">
        <x-forms.label for="jumlah_korban" value="Jumlah Korban">
            <i class="fa-solid fa-users text-gray-500"></i>
        </x-forms.label>
        <x-forms.input type="number" name="jumlah_korban" id="jumlah_korban" placeholder="Misal: 0"
            value="{{ old('jumlah_korban', $insiden->jumlah_korban ?? '') }}" />
    </div>

    <div class="group">
        <x-forms.label for="kerugian" value="Kerugian">
            <i class="fa-solid fa-money-bill-wave text-green-600"></i>
        </x-forms.label>
        <x-forms.input type="text" name="kerugian" id="kerugian" placeholder="Misal: -+ 50 Juta"
            value="{{ old('kerugian', $insiden->kerugian ?? '') }}" />
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="group">
        <x-forms.label for="petugas" value="Petugas Bertugas" required="true">
            <i class="fa-solid fa-user-shield text-indigo-500"></i>
        </x-forms.label>
        <x-forms.dropdown name="petugas[]" id="petugas" multiple="true" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}"
                    {{ in_array($user->id, old('petugas', $petugas_terpilih ?? [])) ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </x-forms.dropdown>
        <small class="text-gray-500 dark:text-gray-400 mt-1 block">* Tekan Ctrl (Windows) atau Cmd (Mac) untuk memilih
            lebih dari satu.</small>
    </div>

    <div class="group">
        <x-forms.label for="status" value="Status Laporan" required="true">
            <i class="fa-solid fa-info-circle text-yellow-500"></i>
        </x-forms.label>
        <x-forms.dropdown name="status" id="status" required>
            @php $currentStatus = old('status', $insiden->status ?? 'Dilaporkan'); @endphp
            <option value="Dilaporkan" {{ $currentStatus == 'Dilaporkan' ? 'selected' : '' }}>🔴 Dilaporkan</option>
            <option value="Berangkat" {{ $currentStatus == 'Berangkat' ? 'selected' : '' }}>🟡 Berangkat</option>
            <option value="Tiba di TKP" {{ $currentStatus == 'Tiba di TKP' ? 'selected' : '' }}>🔵 Tiba di TKP</option>
            <option value="Selesai" {{ $currentStatus == 'Selesai' ? 'selected' : '' }}>🟢 Selesai</option>
        </x-forms.dropdown>
    </div>
</div>

<div class="group mb-6">
    <x-forms.label for="catatan" value="Catatan (Opsional)">
        <i class="fa-solid fa-clipboard text-purple-500"></i>
    </x-forms.label>
    <x-forms.textarea name="catatan" id="catatan" rows="4"
        placeholder="Tambahkan catatan detail...">{{ old('catatan', $insiden->catatan ?? '') }}</x-forms.textarea>
</div>

<div class="group mb-6">
    <x-forms.label value="Foto Dokumentasi (Opsional)">
        <i class="fa-solid fa-camera text-indigo-500"></i>
    </x-forms.label>

    @if (isset($insiden) && $insiden->foto)
        <div class="mb-3">
            <p class="text-sm text-gray-500 mb-2">Foto saat ini:</p>
            <img src="{{ asset($insiden->foto) }}" alt="Foto Insiden"
                class="h-32 rounded-lg border border-gray-300 shadow-sm">
            <p class="text-xs text-amber-500 mt-1"><i class="fa-solid fa-triangle-exclamation"></i> Upload file baru
                jika ingin mengganti foto ini.</p>
        </div>
    @endif

    <x-forms.upload-gambar name="foto" />
</div>
