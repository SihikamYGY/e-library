<nav class="bg-white border-b sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="font-semibold text-xl tracking-tight">
            KamiPerpus
        </a>

        @php
            $route = request()->route()->getName();
            $user = auth()->user();
        @endphp

        {{-- MENU --}}
        <div class="flex items-center gap-6 text-sm">

            <a href="{{ route('home') }}"
                class="{{ $route == 'home' ? 'text-black font-semibold' : 'text-gray-500 hover:text-black' }}">
                Home
            </a>

            <a href="{{ route('books.index') }}"
                class="{{ str_contains($route, 'books') ? 'text-black font-semibold' : 'text-gray-500 hover:text-black' }}">
                Books
            </a>

            <a href="{{ route('syarat') }}"
                class="{{ $route == 'syarat' ? 'text-black font-semibold' : 'text-gray-500 hover:text-black' }}">
                Syarat
            </a>

            @auth
                <a href="{{ route('loans.my') }}"
                    class="{{ $route == 'loans.my' ? 'text-black font-semibold' : 'text-gray-500 hover:text-black' }}">
                    My Loans
                </a>
            @endauth

        </div>

        {{-- RIGHT SIDE --}}
        <div class="flex items-center gap-4">

            @auth

                {{-- PROFILE --}}
                <div class="relative">

                    <button onclick="toggleDropdown()"
                        class="flex items-center gap-3 px-2 py-1 rounded-lg hover:bg-gray-50 transition">

                        {{-- AVATAR --}}
                        <div class="relative w-9 h-9 cursor-pointer" onclick="openAvatarModal(event)">
                            <img src="{{ $user->avatar
                                ? asset('storage/' . $user->avatar)
                                : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                class="w-full h-full rounded-full object-cover border border-gray-200">

                            <span
                                class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-white rounded-full"></span>
                        </div>

                        {{-- NAME --}}
                        <span class="text-sm text-gray-700 hidden md:block font-medium">
                            {{ $user->name }}
                        </span>

                        {{-- ARROW --}}
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>

                    </button>

                    {{-- DROPDOWN --}}
                    <div id="dropdownMenu"
                        class="absolute right-0 mt-2 w-44 bg-white border rounded-xl shadow-lg text-sm
                        opacity-0 scale-95 pointer-events-none
                        transform transition-all duration-150 ease-out">

                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-50">
                                Logout
                            </button>
                        </form>

                    </div>

                    {{-- MODAL --}}
                    <div id="avatarModal"
                        class="fixed inset-0 bg-black/70 flex items-center justify-center
                        opacity-0 pointer-events-none transition duration-200 z-50">

                        <button onclick="closeAvatarModal()"
                            class="absolute top-5 right-5 text-white text-2xl hover:opacity-70">
                            ✕
                        </button>

                        <img src="{{ $user->avatar
                            ? asset('storage/' . $user->avatar)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                            class="w-56 h-56 rounded-full object-cover shadow-2xl border-4 border-white">

                    </div>

                </div>
            @else
                <a href="{{ route('login') }}"
                    class="bg-black text-white px-4 py-2 rounded-lg text-sm hover:opacity-90 transition">
                    Login
                </a>

            @endauth

        </div>

    </div>

</nav>

<script>
    function toggleDropdown() {
        const menu = document.getElementById('dropdownMenu')

        if (!menu) return

        menu.classList.toggle('opacity-0')
        menu.classList.toggle('scale-95')
        menu.classList.toggle('pointer-events-none')

        menu.classList.toggle('opacity-100')
        menu.classList.toggle('scale-100')
        menu.classList.toggle('pointer-events-auto')
    }

    document.addEventListener('click', function(e) {
        const menu = document.getElementById('dropdownMenu')
        const button = e.target.closest('button')

        if (!menu || !button) return

        // kalau klik di luar button & dropdown → close
        if (!menu.contains(e.target) && !button.contains(e.target)) {
            menu.classList.add('opacity-0', 'scale-95', 'pointer-events-none')
            menu.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto')
        }
    })
</script>
