<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="md:col-span-2 group">
        <x-forms.label for="name" value="Nama Lengkap" required="true">
            <i class="fa-solid fa-user text-blue-500"></i>
        </x-forms.label>
        <x-forms.input type="text" name="name" id="name" placeholder="Masukkan nama lengkap"
            value="{{ old('name', $user->name ?? '') }}" required />
    </div>

    <div class="group">
        <x-forms.label for="email" value="Email" required="true">
            <i class="fa-solid fa-envelope text-red-500"></i>
        </x-forms.label>
        <x-forms.input type="email" name="email" id="email" placeholder="nama@email.com"
            value="{{ old('email', $user->email ?? '') }}" required />
    </div>

    <div class="group">
        <x-forms.label for="password" value="Password" :required="!isset($user)">
            <i class="fa-solid fa-lock text-gray-500"></i>
        </x-forms.label>

        <x-forms.input type="password" name="password" id="password"
            placeholder="{{ isset($user) ? 'Kosongkan jika tidak ingin diubah' : 'Minimal 8 karakter' }}"
            :required="!isset($user)" />
    </div>

    <div class="group">
        <x-forms.label for="jenis_kelamin" value="Jenis Kelamin" required="true">
            <i class="fa-solid fa-venus-mars text-purple-500"></i>
        </x-forms.label>
        <x-forms.dropdown name="jenis_kelamin" id="jenis_kelamin" required>
            <option value="">-- Pilih --</option>
            <option value="Laki-laki"
                {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
            </option>
            <option value="Perempuan"
                {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan
            </option>
        </x-forms.dropdown>
    </div>

    <div class="group">
        <x-forms.label for="no_hp" value="No. Handphone" required="true">
            <i class="fa-solid fa-phone text-green-500"></i>
        </x-forms.label>
        <x-forms.input type="text" name="no_hp" id="no_hp" placeholder="08xxxxxxxxxx"
            value="{{ old('no_hp', $user->no_hp ?? '') }}" required />
    </div>

    <div class="group">
        <x-forms.label for="tanggal_lahir" value="Tanggal Lahir">
            <i class="fa-solid fa-calendar-day text-amber-500"></i>
        </x-forms.label>
        <x-forms.input type="date" name="tanggal_lahir" id="tanggal_lahir"
            value="{{ old('tanggal_lahir', $user->tanggal_lahir ?? '') }}" />
    </div>

    <div class="group">
        <x-forms.label for="golongan_darah" value="Golongan Darah">
            <i class="fa-solid fa-droplet text-red-600"></i>
        </x-forms.label>
        <x-forms.dropdown name="golongan_darah" id="golongan_darah">
            <option value="">-- Pilih --</option>
            @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $goldar)
                <option value="{{ $goldar }}"
                    {{ old('golongan_darah', $user->golongan_darah ?? '') == $goldar ? 'selected' : '' }}>
                    {{ $goldar }}</option>
            @endforeach
        </x-forms.dropdown>
    </div>

    <div class="group">
        <x-forms.label for="jabatan" value="Jabatan">
            <i class="fa-solid fa-sitemap text-indigo-500"></i>
        </x-forms.label>
        <x-forms.dropdown name="jabatan" id="jabatan">
            <option value="">-- Pilih Jabatan --</option>
            @foreach (['Komandan', 'Wakil Komandan', 'Danton', 'Petugas Senior', 'Petugas Junior', 'Petugas Lapangan', 'Anggota Regu', 'Petugas Medis', 'Petugas Teknis'] as $jab)
                <option value="{{ $jab }}"
                    {{ old('jabatan', $user->jabatan ?? '') == $jab ? 'selected' : '' }}>{{ $jab }}</option>
            @endforeach
        </x-forms.dropdown>
    </div>

    @if (!isset($hideRole))
        <div class="group">
            <x-forms.label for="role" value="Role Akses" required="true">
                <i class="fa-solid fa-key text-yellow-500"></i>
            </x-forms.label>
            <x-forms.dropdown name="role" id="role" required>
                <option value="">-- Pilih Role --</option>
                @php $currentRole = old('role', $user->role ?? ''); @endphp
                <option value="admin" {{ $currentRole === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="relawan" {{ $currentRole === 'relawan' ? 'selected' : '' }}>Relawan</option>
            </x-forms.dropdown>
        </div>
    @endif

    <div class="md:col-span-2 group">
        <x-forms.label for="status_aktif" value="Status Aktif" required="true">
            <i class="fa-solid fa-heart-pulse text-red-500"></i>
        </x-forms.label>
        <x-forms.dropdown name="status_aktif" id="status_aktif" required>
            <option value="1" {{ old('status_aktif', $user->status_aktif ?? '1') == '1' ? 'selected' : '' }}>Aktif
            </option>
            <option value="0" {{ old('status_aktif', $user->status_aktif ?? '') == '0' ? 'selected' : '' }}>Tidak
                Aktif</option>
        </x-forms.dropdown>
    </div>

    <div class="md:col-span-2 group">
        <x-forms.label for="alamat" value="Alamat Lengkap">
            <i class="fa-solid fa-map-location text-blue-500"></i>
        </x-forms.label>
        <x-forms.textarea name="alamat" id="alamat" rows="2"
            placeholder="Masukkan alamat lengkap">{{ old('alamat', $user->alamat ?? '') }}</x-forms.textarea>
    </div>
</div>
