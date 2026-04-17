<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">

        <div class="w-full max-w-md bg-white border rounded-2xl shadow-sm p-8">

            {{-- HEADER --}}
            <div class="text-center mb-8">

                <div class="w-12 h-12 mx-auto bg-black rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 12a4 4 0 100-8 4 4 0 000 8z" />
                        <path d="M20 21a8 8 0 10-16 0" />
                    </svg>
                </div>

                <h1 class="text-2xl font-semibold">Create Account</h1>
                <p class="text-gray-500 text-sm">Start your reading journey</p>
            </div>

            {{-- FORM --}}
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- NAME --}}
                <div>
                    <x-input-label for="name" value="Name" />
                    <x-text-input id="name"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-black focus:border-black"
                        type="text" name="name" :value="old('name')" required />

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                {{-- EMAIL --}}
                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-black focus:border-black"
                        type="email" name="email" :value="old('email')" required />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- PASSWORD --}}
                <div>
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-black focus:border-black"
                        type="password" name="password" required />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- CONFIRM --}}
                <div>
                    <x-input-label for="password_confirmation" value="Confirm Password" />
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-black focus:border-black"
                        type="password" name="password_confirmation" required />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                {{-- BUTTON --}}
                <button
                    class="w-full bg-black text-white py-3 rounded-xl text-sm hover:bg-gray-900 transition flex items-center justify-center gap-2">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" />
                    </svg>

                    Register
                </button>

            </form>

            {{-- FOOTER --}}
            <p class="text-center text-sm text-gray-500 mt-6">
                Already have account?
                <a href="{{ route('login') }}" class="text-black font-medium">Login</a>
            </p>

        </div>
    </div>
</x-guest-layout>
