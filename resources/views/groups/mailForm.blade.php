<section>
    @push('style')
        <script src="{{ URL::asset('ckeditor/ckeditor.js') }}"></script>
    @endpush
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Send Mass Mail To Groups') }}
        </h2>
    </header>

    <form method="post" action="{{ route('sendGroupMail') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label class="required" for="subject" :value="__('Subject')" />
            <x-text-input id="subject" name="subject" type="text" class="mt-1 block w-full" autocomplete="subject" required />
            <x-input-error class="mt-2" :messages="$errors->get('subject')" />
        </div>

        <div class="form-group">
            <x-input-label class="required" for="body" :value="__('Body')" />
            <textarea class="ckeditor form-control" id="body" name="body" required></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('body')" />
        </div>
        <br>
        <div>
            <x-input-label class="required" for="group_id" :value="__('Group')" />
            <select id="group_id" name="group_id[]" type="group_id" class="mt-1 block w-full" required multiple>
                <option selected>{{ __('Select Group') }}</option>
                @foreach ($groups as $key => $value)
                    <option value="{{ $value }}">
                        {{ $key }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('group_id')" />
        </div>
        <br>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'email-sent')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400">{{ session('message') }}</p>
            @endif

            @if (session('status') === 'email-not-sent')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-red-600 dark:text-red-400">{{ session('message') }}</p>
            @endif
        </div>
    </form>
</section>
