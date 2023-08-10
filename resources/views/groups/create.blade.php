<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Create new group') }}
        </h2>
    </header>
    <form method="post" action="{{ route('groups.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label class="required" for="name" :value="__('Group Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus
                autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'group-created')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400">{{ session('message') }}</p>
            @endif

            @if (session('status') === 'group-not-created')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-red-600 dark:text-red-400">{{ session('message') }}</p>
            @endif
        </div>
    </form>
</section>

