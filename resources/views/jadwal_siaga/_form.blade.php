<div class="space-y-2 mb-6">
    <x-forms.label for="user_id" value="Nama Petugas" required="true">
        <i class="fa-solid fa-user-shield text-red-500"></i>
    </x-forms.label>
    <x-forms.dropdown name="user_id" id="user_id" required>
        <option value="">-- Pilih Petugas --</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}"
                {{ old('user_id', $jadwal_siaga->user_id ?? '') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </x-forms.dropdown>
    @error('user_id')
        <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="space-y-2 mb-6">
    <x-forms.label for="tanggal" value="Tanggal Siaga" required="true">
        <i class="fa-regular fa-calendar-days text-red-500"></i>
    </x-forms.label>
    <x-forms.input type="date" name="tanggal" id="tanggal"
        value="{{ old('tanggal', $jadwal_siaga->tanggal ?? '') }}" required />
    @error('tanggal')
        <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="space-y-2 mb-6">
    <x-forms.label value="Status Petugas" required="true">
        <i class="fa-solid fa-clipboard-user text-red-500"></i>
    </x-forms.label>

    @php $currentStatus = old('status', $jadwal_siaga->status ?? 'Siaga'); @endphp

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <x-forms.radio name="status" value="Siaga" label="Siaga" description="Standby siap tugas" color="amber"
            :checked="$currentStatus === 'Siaga'" />

        <x-forms.radio name="status" value="Tugas" label="Tugas" description="Sedang bertugas" color="red"
            :checked="$currentStatus === 'Tugas'" />

        <x-forms.radio name="status" value="Istirahat" label="Istirahat" description="Waktu istirahat" color="green"
            :checked="$currentStatus === 'Istirahat'" />
    </div>
    @error('status')
        <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
