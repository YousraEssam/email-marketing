<x-app-layout>
    <x-flatpickr::style />
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create new customer') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('customers.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label class="required" for="first_name" :value="__('First Name')" />
                            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="first_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                        </div>

                        <div>
                            <x-input-label class="required" for="last_name" :value="__('Last Name')" />
                            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="last_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                        </div>

                        <div>
                            <x-input-label class="required" for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                required autocomplete="email" aria-placeholder="Email" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <x-input-label class="required" for="group_id" :value="__('Group')" />
                            <select id="group_id" name="group_id[]" type="group_id" class="mt-1 block w-full" required multiple>
                                <option selected>{{ __('Select Group') }}</option>
                                @foreach ($groups as $key=>$value)
                                    <option value="{{ $value }}">
                                        {{ $key }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('group_id')" />
                        </div>

                        <div>
                            <x-input-label for="gender" :value="__('Gender')" />
                            <select id="gender" name="gender" type="gender" class="mt-1 block w-full">
                                <option selected value="">{{ __('Select Gender') }}</option>
                                @foreach ($genderTypes as $type)
                                    <option value="{{ $type->value }}">
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                        </div>

                        <div>
                            <x-input-label for="birth_date" :value="__('Birth Date')" />
                            <x-flatpickr date-format="Y-m-d" :max-date="today()" for="birth_date" name="birth_date"/>
                            <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'customer-created')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-green-600 dark:text-green-400">{{ session('message') }}</p>
                            @endif

                            @if (session('status') === 'customer-not-created')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-red-600 dark:text-red-400">{{ session('message') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-flatpickr::script />
