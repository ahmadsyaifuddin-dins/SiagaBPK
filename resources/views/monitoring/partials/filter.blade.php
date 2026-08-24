<form method="GET" action="{{ route('monitoring.index') }}"
    class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 p-4 md:p-5">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">
                <i class="fa-regular fa-calendar mr-1"></i> Tahun
            </label>
            <select name="tahun"
                class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/60 px-3 py-2.5 text-sm text-gray-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition-colors">
                @foreach ($daftarTahun as $t)
                    <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">
                <i class="fa-solid fa-city mr-1"></i> Kecamatan
            </label>
            <select name="kecamatan"
                class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/60 px-3 py-2.5 text-sm text-gray-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition-colors">
                <option value="">Semua Kecamatan</option>
                @foreach (\App\Models\Insiden::KECAMATAN_BANJARMASIN as $kec)
                    <option value="{{ $kec }}" {{ $kecamatan == $kec ? 'selected' : '' }}>{{ $kec }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1.5">
                <i class="fa-solid fa-fire mr-1"></i> Jenis Insiden
            </label>
            <select name="jenis_insiden"
                class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/60 px-3 py-2.5 text-sm text-gray-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition-colors">
                <option value="">Semua Jenis</option>
                @foreach ($daftarJenis as $jenis)
                    <option value="{{ $jenis }}" {{ $jenisInsiden == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit"
            class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-red-600 to-orange-500 hover:from-red-700 hover:to-orange-600 text-white font-bold py-2.5 px-4 rounded-xl shadow-md transition-all">
            <i class="fa-solid fa-filter"></i> Terapkan Filter
        </button>

    </div>

    @if ($kecamatan || $jenisInsiden)
        <div class="mt-4 pt-3 border-t border-dashed border-gray-200 dark:border-gray-700 flex items-center gap-2 text-xs">
            <span class="text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wide">Filter aktif:</span>
            @if ($kecamatan)
                <span class="px-2 py-1 rounded-md bg-cyan-100 text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-400 font-semibold">{{ $kecamatan }}</span>
            @endif
            @if ($jenisInsiden)
                <span class="px-2 py-1 rounded-md bg-orange-100 text-orange-700 dark:bg-orange-900/40 dark:text-orange-400 font-semibold">{{ $jenisInsiden }}</span>
            @endif
            <a href="{{ route('monitoring.index', ['tahun' => $tahun]) }}"
                class="ml-1 text-red-600 dark:text-red-400 hover:underline font-semibold"><i class="fa-solid fa-xmark"></i> Reset</a>
        </div>
    @endif
</form>
