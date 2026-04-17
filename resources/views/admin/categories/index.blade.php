@extends('layouts.admin')

@section('content')
    <!-- 🔥 HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">
            Categories Overview
        </h1>

        <a href="{{ route('admin.categories.create') }}"
            class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>

            Add Category
        </a>
    </div>

    <!-- 🏆 TOP CATEGORY -->
    @if ($topCategory && $topCategory->books_count > 0)
        <div class="mb-8">

            <div class="bg-white border border-gray-200 p-6 rounded-xl shadow-sm hover:shadow-md transition">

                <div class="flex justify-between items-center">

                    <div>
                        <p class="text-sm text-gray-500 mb-1">Top Category</p>

                        <h2 class="text-xl font-semibold text-gray-800">
                            {{ $topCategory->name }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            {{ $topCategory->books_count }} books
                        </p>
                    </div>

                    <div class="bg-blue-50 p-3 rounded-lg">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2"
                                d="M3 7a2 2 0 012-2h5l2 2h7a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
                        </svg>
                    </div>

                </div>

                <!-- PROGRESS -->
                <div class="mt-4">
                    <div class="flex justify-between text-xs text-gray-400 mb-1">
                        <span>Usage</span>
                        <span>
                            {{ round(($topCategory->books_count / max(1, $totalBooks)) * 100) }}%
                        </span>
                    </div>

                    <div class="w-full bg-gray-100 h-2 rounded-full">
                        <div class="bg-blue-500 h-2 rounded-full transition-all duration-700"
                            style="width: {{ ($topCategory->books_count / max(1, $totalBooks)) * 100 }}%">
                        </div>
                    </div>
                </div>

            </div>

        </div>
    @endif

    <!-- 📊 MINI STATS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        @foreach ($categories as $category)
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-blue-500">

                <div class="flex justify-between items-center mb-2">
                    <p class="text-sm text-gray-500">
                        {{ $category->name }}
                    </p>

                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M3 7a2 2 0 012-2h5l2 2h7a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
                    </svg>
                </div>

                <!-- 🔥 ANIMATED NUMBER -->
                <h2 class="text-2xl font-bold text-gray-800 count" data-target="{{ $category->books_count }}">
                    0
                </h2>

                <p class="text-xs text-gray-400">
                    Books
                </p>

                <!-- PROGRESS -->
                <div class="mt-3">
                    <div class="w-full bg-gray-200 h-2 rounded-full">
                        <div class="bg-blue-500 h-2 rounded-full"
                            style="width: {{ ($category->books_count / max(1, $totalBooks)) * 100 }}%">
                        </div>
                    </div>
                </div>

            </div>
        @endforeach

    </div>

    <!-- 📂 TABLE -->
    <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">

        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                <tr>
                    <th class="p-4">Category</th>
                    <th class="p-4">Books</th>
                    <th class="p-4 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-t hover:bg-gray-50 transition">

                        <!-- NAME -->
                        <td class="p-4 font-medium text-gray-800">
                            {{ $category->name }}
                        </td>

                        <!-- COUNT -->
                        <td class="p-4">
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">
                                {{ $category->books_count }} books
                            </span>
                        </td>

                        <!-- ACTION -->
                        <td class="p-4">
                            <div class="flex justify-center gap-2">

                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="p-2 bg-yellow-100 text-yellow-600 rounded hover:bg-yellow-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="2" d="M15 12H9m12 0A9 9 0 11.001 12 9 9 0 0121 12z" />
                                    </svg>
                                </a>

                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="p-2 bg-red-100 text-red-600 rounded hover:bg-red-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-width="2" d="M6 7h12M9 7v12m6-12v12M4 7l1 14h14l1-14" />
                                        </svg>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-6 text-center text-gray-400">
                            No categories yet
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <!-- 🚀 COUNT ANIMATION -->
    <script>
        const counters = document.querySelectorAll('.count');

        counters.forEach(counter => {
            let target = +counter.getAttribute('data-target');
            let count = 0;

            let speed = target / 30;

            const update = () => {
                count += speed;

                if (count < target) {
                    counter.innerText = Math.floor(count);
                    requestAnimationFrame(update);
                } else {
                    counter.innerText = target;
                }
            };

            update();
        });
    </script>
@endsection
