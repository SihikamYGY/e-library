<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>E-Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    @include('components.navbar')

    @if (session('success'))
        <div id="toast" class="fixed top-5 right-5 bg-black text-white px-4 py-2 rounded text-sm shadow">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div id="toast" class="fixed top-5 right-5 bg-red-500 text-white px-4 py-2 rounded text-sm shadow">
            {{ session('error') }}
        </div>
    @endif

    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast')
            if (toast) toast.remove()
        }, 2500)
    </script>

    <main class="flex-1 max-w-7xl mx-auto px-4 py-6 w-full">
        @yield('content')
    </main>

    @if (session('success'))
        <div
            class="fixed top-5 right-5 z-50 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl shadow-sm flex items-center gap-2">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M5 13l4 4L19 7" />
            </svg>

            <span class="text-sm">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div
            class="fixed top-5 right-5 z-50 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl shadow-sm flex items-center gap-2">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M6 18L18 6M6 6l12 12" />
            </svg>

            <span class="text-sm">{{ session('error') }}</span>
        </div>
    @endif

    <div id="loginModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center">

        <div class="bg-white p-6 rounded-xl w-80 text-center">

            <h2 class="font-semibold mb-2">Login Required</h2>
            <p class="text-sm text-gray-500 mb-4">
                Kamu harus login untuk meminjam buku
            </p>

            <a href="{{ route('login') }}" class="block bg-black text-white py-2 rounded text-sm mb-2">
                Login
            </a>

            <button onclick="closeLoginModal()" class="text-sm text-gray-500">
                Cancel
            </button>

        </div>
    </div>

    <script>
        function openLoginModal() {
            document.getElementById('loginModal').classList.remove('hidden')
            document.getElementById('loginModal').classList.add('flex')
        }

        function closeLoginModal() {
            document.getElementById('loginModal').classList.add('hidden')
        }

        setTimeout(() => {
            document.querySelectorAll('[class*="fixed top-5"]').forEach(el => {
                el.style.transition = "opacity .5s"
                el.style.opacity = "0"
                setTimeout(() => el.remove(), 500)
            })
        }, 3000)
    </script>

    @include('components.footer')

</body>



</html>
