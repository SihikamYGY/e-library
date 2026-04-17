<section class="space-y-4">

    {{-- HEADER --}}
    <div>
        <h2 class="text-lg font-semibold text-gray-900">
            Danger Zone
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Once deleted, your account and all data cannot be recovered.
        </p>
    </div>

    {{-- CARD --}}
    <div class="border border-red-200 bg-red-50 rounded-xl p-5">

        <div class="flex items-start justify-between gap-4">

            {{-- LEFT TEXT --}}
            <div>
                <h3 class="text-sm font-semibold text-red-700">
                    Delete this account
                </h3>

                <p class="text-xs text-red-600 mt-1">
                    All books, loans, and personal data will be permanently removed.
                </p>
            </div>

            {{-- BUTTON --}}
            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm transition">
                Delete
            </x-danger-button>

        </div>

    </div>

    {{-- MODAL --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 space-y-4">

            @csrf
            @method('delete')

            {{-- TITLE --}}
            <h2 class="text-lg font-semibold text-gray-900">
                Confirm account deletion
            </h2>

            <p class="text-sm text-gray-500">
                This action is irreversible. Please enter your password to continue.
            </p>

            {{-- INPUT --}}
            <div>
                <x-input-label for="password" value="Password" class="sr-only" />

                <x-text-input id="password" name="password" type="password"
                    class="mt-1 block w-full rounded-lg border-gray-200 focus:ring-red-500 focus:border-red-500"
                    placeholder="Enter your password" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            {{-- ACTIONS --}}
            <div class="flex justify-end gap-3 pt-2">

                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancel
                </x-secondary-button>

                <x-danger-button class="bg-red-600 hover:bg-red-700">
                    Delete Account
                </x-danger-button>

            </div>

        </form>

    </x-modal>

</section>
