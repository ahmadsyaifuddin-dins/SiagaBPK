@props(['disabled' => false, 'name', 'value' => '', 'id' => null, 'placeholder' => '0'])

@php
    $id = $id ?? $name;
    // Bersihkan value awal dari huruf 'Rp' atau titik (jika data lama dari DB)
    $rawValue = preg_replace('/[^0-9]/', '', $value);
@endphp

<div class="relative">
    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
        <span class="text-gray-500 dark:text-gray-400 sm:text-sm font-bold">Rp</span>
    </div>

    <input type="text" id="visible_{{ $id }}" placeholder="{{ $placeholder }}" value="{{ $rawValue }}"
        {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
            'class' =>
                'pl-11 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900/50 dark:border-gray-700 dark:placeholder-gray-500 dark:text-white transition-colors duration-200',
        ]) !!} oninput="formatCurrency(this, '{{ $id }}')">

    <input type="hidden" name="{{ $name }}" id="{{ $id }}" value="{{ $rawValue }}">
</div>

<script>
    // Memastikan fungsi hanya dideklarasikan sekali meskipun komponen dipanggil berkali-kali
    if (typeof formatCurrency !== 'function') {
        function formatCurrency(input, hiddenId) {
            // Hapus semua karakter selain angka
            let value = input.value.replace(/\D/g, '');

            // Update hidden input dengan angka murni untuk dikirim ke Controller
            document.getElementById(hiddenId).value = value;

            // Format angka ke format ribuan (tambah titik) untuk tampilan
            input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    }

    // Auto-format saat halaman pertama kali diload (berguna saat mode Edit)
    document.addEventListener('DOMContentLoaded', function() {
        let visibleInput = document.getElementById('visible_{{ $id }}');
        if (visibleInput && visibleInput.value) {
            formatCurrency(visibleInput, '{{ $id }}');
        }
    });
</script>
