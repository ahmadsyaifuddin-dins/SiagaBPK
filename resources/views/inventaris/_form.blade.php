<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="group">
        <x-forms.label for="kode_barang" value="Kode Barang" required="true">
            <i class="fa-solid fa-barcode text-gray-500"></i>
        </x-forms.label>
        <x-forms.input type="text" name="kode_barang" id="kode_barang"
            value="{{ old('kode_barang', $inventari->kode_barang ?? ($autoKode ?? '')) }}" required readonly
            class="bg-gray-100 cursor-not-allowed font-mono" />
        <small class="text-xs text-gray-500 mt-1 block">Kode ini di-generate otomatis oleh sistem.</small>
    </div>

    <div class="group">
        <x-forms.label for="nama_barang" value="Nama Barang/Armada" required="true">
            <i class="fa-solid fa-tag text-blue-500"></i>
        </x-forms.label>
        <x-forms.input type="text" name="nama_barang" id="nama_barang" placeholder="Misal: Mobil Tangki Unit 01"
            value="{{ old('nama_barang', $inventari->nama_barang ?? '') }}" required />
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="group">
        <x-forms.label for="kategori" value="Kategori" required="true">
            <i class="fa-solid fa-layer-group text-purple-500"></i>
        </x-forms.label>
        <x-forms.dropdown name="kategori" id="kategori" required>
            @php $currentKat = old('kategori', $inventari->kategori ?? ''); @endphp
            <option value="">-- Pilih Kategori --</option>
            <option value="Armada" {{ $currentKat == 'Armada' ? 'selected' : '' }}>Armada (Mobil/Motor)</option>
            <option value="Peralatan" {{ $currentKat == 'Peralatan' ? 'selected' : '' }}>Peralatan (Pompa/Selang)
            </option>
            <option value="Perlengkapan" {{ $currentKat == 'Perlengkapan' ? 'selected' : '' }}>Perlengkapan (Baju/Helm)
            </option>
            <option value="Lainnya" {{ $currentKat == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
        </x-forms.dropdown>
    </div>

    <div class="group">
        <x-forms.label for="jumlah" value="Jumlah Unit" required="true">
            <i class="fa-solid fa-cubes text-indigo-500"></i>
        </x-forms.label>
        <x-forms.input type="number" name="jumlah" id="jumlah" min="1" placeholder="1"
            value="{{ old('jumlah', $inventari->jumlah ?? '1') }}" required />
    </div>

    <div class="group">
        <x-forms.label for="kondisi" value="Kondisi Fisik" required="true">
            <i class="fa-solid fa-heart-pulse text-red-500"></i>
        </x-forms.label>
        <x-forms.dropdown name="kondisi" id="kondisi" required>
            @php $currentKondisi = old('kondisi', $inventari->kondisi ?? 'Baik'); @endphp
            <option value="Baik" {{ $currentKondisi == 'Baik' ? 'selected' : '' }}>🟢 Baik</option>
            <option value="Rusak Ringan" {{ $currentKondisi == 'Rusak Ringan' ? 'selected' : '' }}>🟡 Rusak Ringan
            </option>
            <option value="Rusak Berat" {{ $currentKondisi == 'Rusak Berat' ? 'selected' : '' }}>🔴 Rusak Berat</option>
        </x-forms.dropdown>
    </div>
</div>

<div class="group mb-6">
    <x-forms.label for="keterangan" value="Keterangan Detail (Opsional)">
        <i class="fa-solid fa-clipboard text-orange-500"></i>
    </x-forms.label>
    <x-forms.textarea name="keterangan" id="keterangan" rows="3"
        placeholder="Spesifikasi, merek, pelat nomor, atau deskripsi kerusakan...">{{ old('keterangan', $inventari->keterangan ?? '') }}</x-forms.textarea>
</div>

<div class="group mb-6">
    <x-forms.label value="Foto Aset/Barang (Opsional)">
        <i class="fa-solid fa-camera text-blue-500"></i>
    </x-forms.label>

    @if (isset($inventari) && $inventari->foto)
        <div
            class="mb-4 bg-gray-50 dark:bg-gray-700/50 p-4 rounded-xl inline-block border border-gray-200 dark:border-gray-600">
            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Foto Saat Ini:</p>
            <img src="{{ asset($inventari->foto) }}" alt="Foto Aset"
                class="h-32 object-cover rounded-lg shadow-sm border border-gray-300 dark:border-gray-600">
            <p class="text-xs text-amber-600 dark:text-amber-400 mt-2 font-medium">
                <i class="fa-solid fa-triangle-exclamation"></i> Upload file baru jika ingin mengganti foto.
            </p>
        </div>
    @endif

    <x-forms.upload-gambar name="foto" />
</div>
