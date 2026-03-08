@props(['name', 'value', 'label', 'description' => '', 'color' => 'amber', 'checked' => false])

@php
    // Mapping warna dinamis berdasarkan prop 'color'
    $colors = [
        'amber' =>
            'border-amber-200 dark:border-amber-600 peer-checked:border-amber-500 peer-checked:bg-amber-50 dark:peer-checked:bg-amber-900/20 bg-amber-500',
        'red' =>
            'border-red-200 dark:border-red-600 peer-checked:border-red-500 peer-checked:bg-red-50 dark:peer-checked:bg-red-900/20 bg-red-500',
        'green' =>
            'border-green-200 dark:border-green-600 peer-checked:border-green-500 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/20 bg-green-500',
    ];
    $theme = $colors[$color] ?? $colors['amber'];
    $bgDot = explode(' ', $theme)[4]; // Mengambil class warna bg dot
@endphp

<label class="relative block w-full">
    <input type="radio" name="{{ $name }}" value="{{ $value }}" class="sr-only peer"
        {{ $checked ? 'checked' : '' }}>
    <div
        class="p-4 bg-white dark:bg-slate-700 border-2 {{ $theme }} rounded-xl cursor-pointer transition-all duration-200 hover:scale-[1.02]">
        <div class="flex items-center space-x-3">
            <div class="w-3 h-3 rounded-full {{ $bgDot }}"></div>
            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $label }}</span>
        </div>
        @if ($description)
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ $description }}</p>
        @endif
    </div>
</label>
