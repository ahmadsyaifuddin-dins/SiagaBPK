<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="group md:col-span-2">
        <x-forms.label for="judul_kegiatan" value="Judul / Nama Kegiatan" required="true">
            <i class="fa-solid fa-heading text-teal-500"></i>
        </x-forms.label>
        <x-forms.input type="text" name="judul_kegiatan" id="judul_kegiatan"
            placeholder="Misal: Latihan Gabungan Hydrant BPK se-Kecamatan"
            value="{{ old('judul_kegiatan', $kegiatan->judul_kegiatan ?? '') }}" required />
    </div>

    <div class="group">
        <x-forms.label for="tanggal_kegiatan" value="Waktu Pelaksanaan" required="true">
            <i class="fa-regular fa-calendar-check text-blue-500"></i>
        </x-forms.label>
        <x-forms.input type="datetime-local" name="tanggal_kegiatan" id="tanggal_kegiatan"
            value="{{ old('tanggal_kegiatan', isset($kegiatan) ? date('Y-m-d\TH:i', strtotime($kegiatan->tanggal_kegiatan)) : now()->format('Y-m-d\TH:i')) }}"
            required />
    </div>

    <div class="group">
        <x-forms.label for="lokasi" value="Lokasi Acara" required="true">
            <i class="fa-solid fa-location-dot text-red-500"></i>
        </x-forms.label>
        <x-forms.input type="text" name="lokasi" id="lokasi" placeholder="Misal: Lapangan Murjani..."
            value="{{ old('lokasi', $kegiatan->lokasi ?? '') }}" required />
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="group">
        <x-forms.label for="status" value="Status Kegiatan" required="true">
            <i class="fa-solid fa-info-circle text-orange-500"></i>
        </x-forms.label>
        <x-forms.dropdown name="status" id="status" required>
            @php $currentStatus = old('status', $kegiatan->status ?? 'Akan Datang'); @endphp
            <option value="Akan Datang" {{ $currentStatus == 'Akan Datang' ? 'selected' : '' }}>⏳ Akan Datang</option>
            <option value="Selesai" {{ $currentStatus == 'Selesai' ? 'selected' : '' }}>✅ Selesai</option>
            <option value="Batal" {{ $currentStatus == 'Batal' ? 'selected' : '' }}>❌ Batal</option>
        </x-forms.dropdown>
        <small class="text-xs text-gray-500 mt-1 block">Bisa digunakan untuk sekadar pengumuman jadwal jika status "Akan
            Datang".</small>
    </div>
</div>

<div class="group mb-6">
    <x-forms.label for="deskripsi" value="Deskripsi / Narasi Kegiatan" required="true">
        <i class="fa-solid fa-align-left text-purple-500"></i>
    </x-forms.label>
    <x-forms.textarea name="deskripsi" id="deskripsi" rows="5"
        placeholder="Tuliskan cerita, tujuan, atau detail siapa saja yang berhadir dalam kegiatan ini...">{{ old('deskripsi', $kegiatan->deskripsi ?? '') }}</x-forms.textarea>
</div>

<div class="group mb-6">
    <x-forms.label value="Foto Dokumentasi Utama (Opsional)">
        <i class="fa-solid fa-image text-indigo-500"></i>
    </x-forms.label>

    @if (isset($kegiatan) && $kegiatan->foto)
        <div class="mb-4 bg-gray-50 dark:bg-gray-700/50 p-4 rounded-xl inline-block border border-gray-200">
            <img src="{{ asset($kegiatan->foto) }}" alt="Foto Kegiatan" class="h-40 object-cover rounded-lg shadow-sm">
            <p class="text-xs text-amber-600 mt-2 font-medium">Upload gambar baru jika ingin mengganti foto.</p>
        </div>
    @endif

    <x-forms.upload-gambar name="foto" />
</div>
