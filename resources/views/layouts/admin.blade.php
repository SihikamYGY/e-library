<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <!-- Sidebar (FIXED) -->
    <div class="fixed top-0 left-0 w-64 h-screen bg-gray-800 text-white p-5">
        <h1 class="text-xl font-bold mb-5">Admin Panel</h1>

        <ul class="space-y-3">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="block hover:text-gray-300">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('admin.books.index') }}" class="block hover:text-gray-300">Books</a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}" class="block hover:text-gray-300">Categories</a>
            </li>
            <li>
                <a href="#" class="block hover:text-gray-300">Loans</a>
            </li>
            <li class="mt-5">
                <a href="/" class="text-sm text-gray-400">← Back to Homepage</a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="ml-64 p-6 min-h-screen">
        @yield('content')
    </div>

</body>

</html>