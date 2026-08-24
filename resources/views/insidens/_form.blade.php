@auth
    <input type="hidden" name="dilaporkan_oleh" value="{{ auth()->id() }}">
    <div
        class="text-sm text-gray-600 dark:text-gray-300 mb-6 bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-100 dark:border-blue-800 flex items-center">
        <i class="fa-solid fa-user-shield text-blue-500 mr-3 text-lg"></i>
        <div>
            <span class="block text-xs text-gray-500 dark:text-gray-400">Penerima Laporan / Petugas Jaga:</span>
            <span class="font-bold text-blue-700 dark:text-blue-400">{{ auth()->user()->name }}
                ({{ ucfirst(auth()->user()->role) }})</span>
        </div>
    </div>
@endauth

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="group">
        <x-forms.label for="nama_pelapor" value="Nama Pelapor (Warga / Instansi)" required="true">
            <i class="fa-solid fa-user text-blue-500"></i>
        </x-forms.label>
        <x-forms.input type="text" name="nama_pelapor" id="nama_pelapor"
            value="{{ old('nama_pelapor', $insiden->nama_pelapor ?? '') }}" required
            placeholder="Masukkan nama pelapor..." />
    </div>
    <div class="group">
        <x-forms.label for="kontak_pelapor" value="Kontak Pelapor (No. HP/WA)" required="true">
            <i class="fa-solid fa-phone text-green-500"></i>
        </x-forms.label>
        <x-forms.input type="text" name="kontak_pelapor" id="kontak_pelapor"
            value="{{ old('kontak_pelapor', $insiden->kontak_pelapor ?? '') }}" required
            placeholder="Contoh: 08123456789" />
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="group">
        <x-forms.label for="lokasi" value="Lokasi Kejadian (Jalan/Daerah)" required="true">
            <i class="fa-solid fa-location-dot text-red-500"></i>
        </x-forms.label>

        <div class="flex gap-2">
            <x-forms.input type="text" name="lokasi" id="lokasi" placeholder="Misal: Jl. Hasan Basri..."
                value="{{ old('lokasi', $insiden->lokasi ?? '') }}" required class="w-full" />

            <button type="button" onclick="getLocation()"
                class="shrink-0 bg-blue-100 text-blue-700 hover:bg-blue-200 dark:bg-blue-900/40 dark:text-blue-400 dark:hover:bg-blue-800/50 px-3 py-2 rounded-lg border border-blue-200 dark:border-blue-800 font-medium transition-colors"
                title="Deteksi Koordinat GPS">
                <i id="gps-icon" class="fa-solid fa-location-crosshairs"></i>
            </button>
        </div>

        <div class="flex gap-2 mt-2">
            <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $insiden->latitude ?? '') }}"
                placeholder="Latitude (Otomatis)" readonly
                class="w-1/2 bg-gray-100 dark:bg-gray-800 text-xs text-gray-500 dark:text-gray-400 border-gray-300 dark:border-gray-700 rounded-md cursor-not-allowed">
            <input type="text" name="longitude" id="longitude"
                value="{{ old('longitude', $insiden->longitude ?? '') }}" placeholder="Longitude (Otomatis)" readonly
                class="w-1/2 bg-gray-100 dark:bg-gray-800 text-xs text-gray-500 dark:text-gray-400 border-gray-300 dark:border-gray-700 rounded-md cursor-not-allowed">
        </div>
        <small id="geo-status" class="text-xs text-gray-500 mt-1 block">Tekan ikon target untuk mendapatkan koordinat
            presisi. (Wajib izinkan akses lokasi)</small>
    </div>

    <div class="group">
        <x-forms.label for="waktu_kejadian" value="Waktu Kejadian" required="true">
            <i class="fa-solid fa-clock text-orange-500"></i>
        </x-forms.label>
        <x-forms.input type="datetime-local" name="waktu_kejadian" id="waktu_kejadian"
            value="{{ old('waktu_kejadian', isset($insiden) ? date('Y-m-d\TH:i', strtotime($insiden->waktu_kejadian)) : now()->format('Y-m-d\TH:i')) }}"
            required />
    </div>
</div>

@include('insidens.partials.geo-script')

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="group">
        <x-forms.label for="kecamatan" value="Kecamatan">
            <i class="fa-solid fa-city text-cyan-500"></i>
        </x-forms.label>
        @php $currentKecamatan = old('kecamatan', $insiden->kecamatan ?? ''); @endphp
        <select name="kecamatan" id="kecamatan"
            class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 px-4 py-2.5 text-sm text-gray-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
            <option value="">-- Pilih Kecamatan --</option>
            @foreach (\App\Models\Insiden::KECAMATAN_BANJARMASIN as $kec)
                <option value="{{ $kec }}" {{ $currentKecamatan == $kec ? 'selected' : '' }}>{{ $kec }}</option>
            @endforeach
            <option value="Luar Kota Banjarmasin" {{ $currentKecamatan == 'Luar Kota Banjarmasin' ? 'selected' : '' }}>
                Luar Kota Banjarmasin</option>
        </select>
    </div>

    <div class="group">
        <x-forms.label for="kelurahan" value="Kelurahan / Desa">
            <i class="fa-solid fa-map-pin text-teal-500"></i>
        </x-forms.label>
        <input type="text" name="kelurahan" id="kelurahan" list="daftar-kelurahan"
            value="{{ old('kelurahan', $insiden->kelurahan ?? '') }}"
            placeholder="Ketik atau pilih kelurahan..."
            class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 px-4 py-2.5 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200" />
        <datalist id="daftar-kelurahan">
            <option value="">-- Pilih Kelurahan --</option>
        </datalist>
        <small class="text-xs text-gray-500 mt-1 block">Pilihan kelurahan menyesuaikan kecamatan yang dipilih.</small>
    </div>
</div>

<script>
    // Daftar kelurahan resmi Kota Banjarmasin per kecamatan
    const dataKelurahan = {
        "Banjarmasin Barat": ["Basirih", "Belitung Selatan", "Belitung Utara", "Kuin Cerucuk", "Kuin Selatan", "Pelambuan", "Telaga Biru", "Telawang", "Teluk Tiram"],
        "Banjarmasin Selatan": ["Basirih Selatan", "Kelayan Barat", "Kelayan Dalam", "Kelayan Tengah", "Kelayan Timur", "Kelayan Selatan", "Mantuil", "Murung Raya", "Pekauman", "Pemurus Baru", "Pemurus Dalam", "Tanjung Pagar"],
        "Banjarmasin Tengah": ["Antasan Besar", "Gadang", "Kertak Baru Ilir", "Kertak Baru Ulu", "Kelayan Luar", "Mawar", "Melayu", "Pasar Lama", "Pekapuran Laut", "Seberang Mesjid", "Sungai Baru", "Teluk Dalam"],
        "Banjarmasin Timur": ["Benua Anyar", "Karang Mekar", "Kebun Bunga", "Kuripan", "Pekapuran Raya", "Pemurus Luar", "Pengambangan", "Sungai Bilu", "Sungai Lulut"],
        "Banjarmasin Utara": ["Alalak Utara", "Alalak Tengah", "Alalak Selatan", "Antasan Kecil Timur", "Kuin Utara", "Pangeran", "Sungai Andai", "Sungai Jingah", "Sungai Miai", "Surgi Mufti"]
    };

    function perbaruiKelurahan() {
        const kec = document.getElementById('kecamatan');
        const kel = document.getElementById('kelurahan');
        const list = document.getElementById('daftar-kelurahan');
        if (!kec || !list) return;

        list.innerHTML = '';
        (dataKelurahan[kec.value] || []).forEach(function(nama) {
            const opt = document.createElement('option');
            opt.value = nama;
            list.appendChild(opt);
        });

        // Kosongkan kelurahan jika berganti kecamatan ke wilayah lain
        const opsi = Array.from(list.options).map(o => o.value);
        if (opsi.length > 0 && !opsi.includes(kel.value)) {
            kel.value = '';
        }
    }

    document.getElementById('kecamatan').addEventListener('change', perbaruiKelurahan);
    document.addEventListener('DOMContentLoaded', perbaruiKelurahan);
</script>

<div class="group mb-6">
    <x-forms.label for="jenis_insiden" value="Jenis Insiden" required="true">
        <i class="fa-solid fa-fire text-orange-500"></i>
    </x-forms.label>
    <x-forms.input type="text" name="jenis_insiden" id="jenis_insiden"
        placeholder="Kebakaran Rumah, Ada Ular didalam rumah, dll..."
        value="{{ old('jenis_insiden', $insiden->jenis_insiden ?? '') }}" required />
</div>

{{-- ===== DETAIL DATA KORBAN ===== --}}
<div
    class="bg-red-50/60 dark:bg-red-900/10 p-4 rounded-xl border border-red-100 dark:border-red-800/50 mb-6">
    <h4 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
        <i class="fa-solid fa-users-viewfinder text-red-500 mr-2"></i> Detail Data Korban Kejadian
    </h4>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="group">
            <x-forms.label for="korban_meninggal" value="Korban Meninggal Dunia">
                <i class="fa-solid fa-heart-crack text-red-600"></i>
            </x-forms.label>
            <div class="relative">
                <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-xs text-gray-400">jiwa</span>
                <x-forms.input type="number" name="korban_meninggal" id="korban_meninggal" min="0"
                    value="{{ old('korban_meninggal', $insiden->korban_meninggal ?? 0) }}" class="pr-12" />
            </div>
        </div>

        <div class="group">
            <x-forms.label for="korban_luka_berat" value="Korban Luka Berat">
                <i class="fa-solid fa-user-injured text-orange-500"></i>
            </x-forms.label>
            <div class="relative">
                <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-xs text-gray-400">jiwa</span>
                <x-forms.input type="number" name="korban_luka_berat" id="korban_luka_berat" min="0"
                    value="{{ old('korban_luka_berat', $insiden->korban_luka_berat ?? 0) }}" class="pr-12" />
            </div>
        </div>

        <div class="group">
            <x-forms.label for="korban_luka_ringan" value="Korban Luka Ringan">
                <i class="fa-solid fa-band-aid text-yellow-500"></i>
            </x-forms.label>
            <div class="relative">
                <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-xs text-gray-400">jiwa</span>
                <x-forms.input type="number" name="korban_luka_ringan" id="korban_luka_ringan" min="0"
                    value="{{ old('korban_luka_ringan', $insiden->korban_luka_ringan ?? 0) }}" class="pr-12" />
            </div>
        </div>

        <div class="group">
            <x-forms.label for="korban_jiwa_terdampak" value="Total Jiwa Terdampak">
                <i class="fa-solid fa-users text-purple-500"></i>
            </x-forms.label>
            <div class="relative">
                <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-xs text-gray-400">jiwa</span>
                <x-forms.input type="number" name="korban_jiwa_terdampak" id="korban_jiwa_terdampak" min="0"
                    value="{{ old('korban_jiwa_terdampak', $insiden->korban_jiwa_terdampak ?? 0) }}" class="pr-12" />
            </div>
            <small class="text-xs text-gray-500 mt-1 block">Seluruh warga yang terdampak (termasuk selamat).</small>
        </div>

        <div class="group">
            <x-forms.label for="korban_mengungsi_kk" value="Pengungsi (Kepala Keluarga)">
                <i class="fa-solid fa-house-circle-exclamation text-indigo-500"></i>
            </x-forms.label>
            <div class="relative">
                <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-xs text-gray-400">KK</span>
                <x-forms.input type="number" name="korban_mengungsi_kk" id="korban_mengungsi_kk" min="0"
                    value="{{ old('korban_mengungsi_kk', $insiden->korban_mengungsi_kk ?? 0) }}" class="pr-8" />
            </div>
        </div>

        <div class="group">
            <x-forms.label for="korban_mengungsi_jiwa" value="Pengungsi (Jiwa)">
                <i class="fa-solid fa-people-roof text-blue-500"></i>
            </x-forms.label>
            <div class="relative">
                <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-xs text-gray-400">jiwa</span>
                <x-forms.input type="number" name="korban_mengungsi_jiwa" id="korban_mengungsi_jiwa" min="0"
                    value="{{ old('korban_mengungsi_jiwa', $insiden->korban_mengungsi_jiwa ?? 0) }}" class="pr-12" />
            </div>
        </div>
    </div>
</div>
{{-- ===== AKHIR DETAIL KORBAN ===== --}}

@if (in_array(auth()->user()->role, ['admin', 'petugas_lapangan']))
    <div class="bg-gray-50 dark:bg-gray-800/50 p-4 rounded-xl border border-gray-200 dark:border-gray-700 mb-6">
        <h4 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
            <i class="fa-solid fa-shield-halved text-indigo-500 mr-2"></i> Kolom Khusus Petugas
        </h4>

        {{-- Detail Kerusakan & Kerugian --}}
        <div class="mb-6 pb-6 border-b border-dashed border-gray-200 dark:border-gray-700">
            <h5 class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-4 flex items-center">
                <i class="fa-solid fa-house-crack text-red-500 mr-2"></i> Detail Kerusakan & Kerugian Material
            </h5>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="group">
                    <x-forms.label for="rumah_terbakar" value="Rumah Terbakar">
                        <i class="fa-solid fa-fire text-red-500"></i>
                    </x-forms.label>
                    <div class="relative">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-xs text-gray-400">unit</span>
                        <x-forms.input type="number" name="rumah_terbakar" id="rumah_terbakar" min="0"
                            value="{{ old('rumah_terbakar', $insiden->rumah_terbakar ?? 0) }}" class="pr-12" />
                    </div>
                </div>

                <div class="group">
                    <x-forms.label for="rumah_rusak" value="Rumah Rusak">
                        <i class="fa-solid fa-house-chimney-crack text-amber-500"></i>
                    </x-forms.label>
                    <div class="relative">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-xs text-gray-400">unit</span>
                        <x-forms.input type="number" name="rumah_rusak" id="rumah_rusak" min="0"
                            value="{{ old('rumah_rusak', $insiden->rumah_rusak ?? 0) }}" class="pr-12" />
                    </div>
                </div>

                <div class="group">
                    <x-forms.label for="bangunan_lain_terdampak" value="Bangunan Lain Terdampak">
                        <i class="fa-solid fa-store text-emerald-500"></i>
                    </x-forms.label>
                    <div class="relative">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-xs text-gray-400">unit</span>
                        <x-forms.input type="number" name="bangunan_lain_terdampak" id="bangunan_lain_terdampak" min="0"
                            value="{{ old('bangunan_lain_terdampak', $insiden->bangunan_lain_terdampak ?? 0) }}"
                            class="pr-12" />
                    </div>
                    <small class="text-xs text-gray-500 mt-1 block">Toko, gudang, kios, warung, dll.</small>
                </div>

                <div class="group">
                    <x-forms.label for="kendaraan_terbakar" value="Kendaraan Terbakar">
                        <i class="fa-solid fa-motorcycle text-sky-500"></i>
                    </x-forms.label>
                    <div class="relative">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-xs text-gray-400">unit</span>
                        <x-forms.input type="number" name="kendaraan_terbakar" id="kendaraan_terbakar" min="0"
                            value="{{ old('kendaraan_terbakar', $insiden->kendaraan_terbakar ?? 0) }}" class="pr-12" />
                    </div>
                </div>

                <div class="group">
                    <x-forms.label for="luas_area_dampak" value="Luas Area Terdampak">
                        <i class="fa-solid fa-ruler-combined text-lime-500"></i>
                    </x-forms.label>
                    <div class="relative">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-xs text-gray-400">m²</span>
                        <x-forms.input type="number" step="0.01" name="luas_area_dampak" id="luas_area_dampak" min="0"
                            value="{{ old('luas_area_dampak', $insiden->luas_area_dampak ?? '') }}" class="pr-10" />
                    </div>
                </div>

                <div class="group">
                    <x-forms.label for="kerugian_material" value="Taksiran Kerugian Material">
                        <i class="fa-solid fa-sack-dollar text-red-500"></i>
                    </x-forms.label>
                    <x-forms.input-currency name="kerugian_material" id="kerugian_material" placeholder="Contoh: 15.000.000"
                        value="{{ old('kerugian_material', $insiden->kerugian_material ?? '') }}" />
                    <small class="text-xs text-gray-500 mt-1 block">Kosongkan / 0 jika tidak ada kerugian material.</small>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

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
