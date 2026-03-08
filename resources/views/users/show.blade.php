<x-app-layout>
    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @include('users.partials.show.header')

            @include('users.partials.show.profile-card')

            @include('users.partials.show.details')

        </div>
    </div>
</x-app-layout>
