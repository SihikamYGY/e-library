<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">

        <div class="w-full max-w-md bg-white border rounded-2xl shadow-sm p-8">

            {{-- HEADER --}}
            <div class="text-center mb-8">

                <div class="w-12 h-12 mx-auto bg-black rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M16 14a4 4 0 01-8 0" />
                        <path d="M12 14V3" />
                        <path d="M8 7l4-4 4 4" />
                    </svg>
                </div>

                <h1 class="text-2xl font-semibold">Welcome Back</h1>
                <p class="text-gray-500 text-sm">Login to continue reading books</p>
            </div>

            {{-- SESSION STATUS --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- FORM --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- EMAIL --}}
                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-black focus:border-black"
                        type="email" name="email" :value="old('email')" required autofocus />

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

                {{-- REMEMBER --}}
                <div class="flex items-center justify-between mt-2">

                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="rounded border-gray-300 text-black focus:ring-black"
                            name="remember">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-500 hover:text-black" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif

                </div>

                {{-- BUTTON --}}
                <button
                    class="w-full bg-black text-white py-3 rounded-xl text-sm hover:bg-gray-900 transition flex items-center justify-center gap-2">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M5 12h14" />
                        <path d="M12 5l7 7-7 7" />
                    </svg>

                    Log in
                </button>

            </form>

            {{-- FOOTER --}}
            <p class="text-center text-sm text-gray-500 mt-6">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-black font-medium">Register</a>
            </p>

        </div>
    </div>
</x-guest-layout>
