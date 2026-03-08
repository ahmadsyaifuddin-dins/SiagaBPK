<div class="grid grid-cols-1 gap-6 mb-6">
    <div class="group">
        <x-forms.label for="inventaris_id" value="Aset / Armada yang Diservis" required="true">
            <i class="fa-solid fa-truck-fast text-blue-500"></i>
        </x-forms.label>
        <x-forms.dropdown name="inventaris_id" id="inventaris_id" required>
            <option value="">-- Pilih Aset yang Berkaitan --</option>
            @php
                $currentAset = old('inventaris_id', $maintenance->inventaris_id ?? ($selected_inventaris_id ?? ''));
            @endphp
            @foreach ($inventaris as $inv)
                <option value="{{ $inv->id }}" {{ $currentAset == $inv->id ? 'selected' : '' }}>
                    {{ $inv->kode_barang }} - {{ $inv->nama_barang }}
                </option>
            @endforeach
        </x-forms.dropdown>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="group">
        <x-forms.label for="tanggal_servis" value="Tanggal Servis" required="true">
            <i class="fa-solid fa-calendar-day text-green-500"></i>
        </x-forms.label>
        <x-forms.input type="date" name="tanggal_servis" id="tanggal_servis"
            value="{{ old('tanggal_servis', $maintenance->tanggal_servis ?? now()->format('Y-m-d')) }}" required />
    </div>

    <div class="group">
        <x-forms.label for="jenis_servis" value="Jenis Servis" required="true">
            <i class="fa-solid fa-wrench text-orange-500"></i>
        </x-forms.label>
        <x-forms.input type="text" name="jenis_servis" id="jenis_servis" placeholder="Misal: Ganti Oli Mesin"
            value="{{ old('jenis_servis', $maintenance->jenis_servis ?? '') }}" required />
    </div>

    <div class="group">
        <x-forms.label for="biaya" value="Total Biaya (Rp)" required="true">
            <i class="fa-solid fa-money-bill-wave text-emerald-600"></i>
        </x-forms.label>
        <x-forms.input type="number" name="biaya" id="biaya" min="0" placeholder="500000"
            value="{{ old('biaya', $maintenance->biaya ?? '0') }}" required />
    </div>
</div>

<div class="group mb-6">
    <x-forms.label for="keterangan" value="Keterangan / Detail Perbaikan (Opsional)">
        <i class="fa-solid fa-clipboard text-purple-500"></i>
    </x-forms.label>
    <x-forms.textarea name="keterangan" id="keterangan" rows="3"
        placeholder="Catatan kerusakan, suku cadang yang diganti, nama bengkel...">{{ old('keterangan', $maintenance->keterangan ?? '') }}</x-forms.textarea>
</div>

<div class="group mb-6">
    <x-forms.label value="Foto Nota / Kuitansi Servis (Opsional)">
        <i class="fa-solid fa-receipt text-gray-500"></i>
    </x-forms.label>

    @if (isset($maintenance) && $maintenance->nota_servis)
        <div
            class="mb-4 bg-gray-50 dark:bg-gray-700/50 p-4 rounded-xl inline-block border border-gray-200 dark:border-gray-600">
            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nota Saat Ini:</p>
            <img src="{{ asset($maintenance->nota_servis) }}" alt="Nota Servis"
                class="h-40 object-cover rounded-lg shadow-sm border border-gray-300 dark:border-gray-600">
            <p class="text-xs text-amber-600 dark:text-amber-400 mt-2 font-medium">
                <i class="fa-solid fa-triangle-exclamation"></i> Upload gambar baru jika ingin menimpa nota ini.
            </p>
        </div>
    @endif

    <x-forms.upload-gambar name="nota_servis" />
</div>
