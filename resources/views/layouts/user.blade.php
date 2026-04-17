<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

    @include('components.navbar')

    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    @include('components.footer')

</body>
</html>