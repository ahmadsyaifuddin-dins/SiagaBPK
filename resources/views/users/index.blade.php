<x-app-layout>
    <div x-data="{ isModalOpen: {{ $errors->any() ? 'true' : 'false' }} }" class="py-8 min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @include('users.partials.header')

            @include('users.partials.table')

        </div>

        @include('users.partials.modal')

    </div>
</x-app-layout>
