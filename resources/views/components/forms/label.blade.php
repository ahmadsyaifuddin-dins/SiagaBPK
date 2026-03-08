@props(['value', 'required' => false])

<label
    {{ $attributes->merge(['class' => 'block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-400 transition-colors']) }}>
    <span class="flex items-center">
        @if ($slot->isNotEmpty())
            <span class="mr-2">{{ $slot }}</span>
        @endif

        {{ $value }}

        @if ($required)
            <span class="text-red-500 ml-1">*</span>
        @endif
    </span>
</label>
