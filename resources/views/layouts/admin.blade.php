<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">

    <!-- SIDEBAR -->
    <!-- SIDEBAR -->
    <div class="fixed top-0 left-0 w-64 h-screen bg-gray-900 text-white flex flex-col">

        <!-- LOGO -->
        <div class="p-6 border-b border-gray-700">
            <h1 class="text-lg font-semibold tracking-wide">E-Library</h1>
            <p class="text-xs text-gray-400">Admin Panel</p>
        </div>

        <!-- MENU -->
        <nav class="flex-1 p-4 space-y-2 text-sm">

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-800
            {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">

                <!-- ICON -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 13h8V3H3v10zm10 8h8V11h-8v10zM3 21h8v-6H3v6zM13 3v6h8V3h-8z" />
                </svg>

                Dashboard
            </a>

            <!-- Books -->
            <a href="{{ route('admin.books.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-800
            {{ request()->routeIs('admin.books.*') ? 'bg-gray-800' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6l-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h5l2-2m0-12l2-2h5a2 2 0 012 2v12a2 2 0 01-2 2h-5l-2-2" />
                </svg>

                Books
            </a>

            <!-- Categories -->
            <a href="{{ route('admin.categories.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-800
            {{ request()->routeIs('admin.categories.*') ? 'bg-gray-800' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                </svg>

                Categories
            </a>

            <!-- Loans -->
            <a href="{{ route('admin.loans.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-800
            {{ request()->routeIs('admin.loans.*') ? 'bg-gray-800' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 9V7a4 4 0 00-8 0v2M5 9h14l1 12H4L5 9z" />
                </svg>

                Loans
            </a>

        </nav>

        <!-- FOOTER -->
        <div class="p-4 border-t border-gray-700 text-sm">
            <a href="/" class="text-gray-400 hover:text-white block mb-2">Back to Site</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-red-400 hover:text-red-500 w-full text-left">
                    Logout
                </button>
            </form>
        </div>

    </div>

    <!-- MAIN CONTENT -->
    <div class="ml-64 min-h-screen flex flex-col">

        <!-- TOPBAR -->
        <div class="bg-white shadow px-6 py-4 flex justify-between items-center">

            <!-- TITLE -->
            <h2 class="font-semibold text-gray-700 text-lg">
                @yield('title', 'Dashboard')
            </h2>

            <!-- USER PROFILE -->
            <div class="relative">

                <button onclick="toggleDropdown()" class="flex items-center gap-3 focus:outline-none">

                    <!-- AVATAR -->
                    <div class="relative w-10 h-10 cursor-pointer" onclick="openAvatarModal(event)">
                        <img src="{{ auth()->user()->avatar
                            ? asset('storage/' . auth()->user()->avatar)
                            : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                            class="w-full h-full rounded-full object-cover border border-gray-200">

                        <!-- ONLINE DOT -->
                        <span
                            class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                    </div>

                    <!-- NAME -->
                    <span class="text-sm text-gray-700 hidden md:block">
                        {{ auth()->user()->name }}
                    </span>

                    <!-- ARROW -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>

                </button>


                <!-- DROPDOWN -->
                <div id="dropdownMenu"
                    class="absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow-md text-sm
    opacity-0 scale-95 pointer-events-none
    transform transition-all duration-200 ease-out">

                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">
                        Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-500">
                            Logout
                        </button>
                    </form>

                </div>

                <!-- MODAL PREVIEW -->
                <!-- MODAL PREVIEW -->
                <div id="avatarModal"
                    class="fixed inset-0 bg-black/70 flex items-center justify-center
    opacity-0 pointer-events-none transition duration-200 z-50">

                    <!-- CLOSE BUTTON -->
                    <button onclick="closeAvatarModal()" class="absolute top-5 right-5 text-white text-2xl">
                        ✕
                    </button>

                    <!-- IMAGE (NO BORDER) -->
                    <img src="{{ auth()->user()->avatar
                        ? asset('storage/' . auth()->user()->avatar)
                        : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                        class="w-52 h-52 rounded-full object-cover shadow-lg">

                </div>



            </div>

        </div>

        <!-- PAGE CONTENT -->
        <main class="py-4 sm:py-6">
            <div class="px-3 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

    </div>

</body>

<script>
    function openAvatarModal(e) {
        e.stopPropagation(); // 🔥 ini penting biar ga trigger dropdown

        const modal = document.getElementById('avatarModal');
        modal.classList.remove('opacity-0', 'pointer-events-none');
    }

    function closeAvatarModal() {
        const modal = document.getElementById('avatarModal');
        modal.classList.add('opacity-0', 'pointer-events-none');
    }

    // klik luar modal = close
    document.getElementById('avatarModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeAvatarModal();
        }
    });



    function toggleDropdown() {
        const dropdown = document.getElementById('dropdownMenu');

        if (dropdown.classList.contains('opacity-0')) {
            // OPEN
            dropdown.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
            dropdown.classList.add('opacity-100', 'scale-100');
        } else {
            // CLOSE
            dropdown.classList.remove('opacity-100', 'scale-100');
            dropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
        }
    }

    // close kalau klik luar
    window.addEventListener('click', function(e) {
        const dropdown = document.getElementById('dropdownMenu');
        const button = e.target.closest('button');

        if (!button && dropdown) {
            dropdown.classList.remove('opacity-100', 'scale-100');
            dropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
        }
    });
</script>

</html>
