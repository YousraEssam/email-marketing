<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Welcome `" . Auth::user()->name . "`, You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    
    @if (session('status') === 'email-sent')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
            class="text-sm text-green-600 dark:text-green-400">{{ session('message') }}</p>
    @endif

    @if (session('status') === 'email-not-sent')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
            class="text-sm text-red-600 dark:text-red-400">{{ session('message') }}</p>
    @endif
</x-app-layout>
