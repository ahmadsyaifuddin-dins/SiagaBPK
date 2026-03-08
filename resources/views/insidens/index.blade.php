<x-app-layout>
    <div
        class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 transition-colors duration-300">
        <div class="p-6 max-w-7xl mx-auto">

            @include('insidens.partials.index.header')

            @include('insidens.partials.index.stats')

            @include('insidens.partials.index.table')

        </div>
    </div>
</x-app-layout>
