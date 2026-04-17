@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Books</h1>

        <a href="{{ route('admin.books.create') }}"
            class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">

            <!-- PLUS ICON -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>

            Add Book
        </a>
    </div>

    <!-- 🔍 FILTER + SEARCH -->
    <div class="bg-white p-4 rounded-xl shadow-sm mb-6 flex flex-col md:flex-row gap-3 md:items-center md:justify-between">

        <form method="GET" class="flex gap-3 w-full md:w-auto">

            <!-- SEARCH -->
            <div class="relative w-full md:w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search book..."
                    class="w-full border rounded-lg pl-10 pr-3 py-2 focus:ring-2 focus:ring-blue-400">

                <svg class="w-4 h-4 absolute left-3 top-3 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                </svg>
            </div>

            <!-- CATEGORY -->
            <select name="category" class="border rounded-lg px-5 py-2 focus:ring-2 focus:ring-blue-400">
                <option value="">All Category</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <button class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-900">
                Filter
            </button>
        </form>
    </div>

    <!-- 📚 TABLE -->
    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="p-4">Book</th>
                    <th class="p-4">Author</th>
                    <th class="p-4">Stock</th>
                    <th class="p-4">Category</th>
                    <th class="p-4 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($books as $book)
                    <tr class="border-t hover:bg-gray-50 transition">

                        <!-- BOOK INFO -->
                        <td class="p-4 flex items-center gap-4">

                            <div class="relative group w-12 h-16 cursor-pointer"
                                onclick="openCoverModal('{{ asset('storage/' . $book->cover) }}')">

                                @if ($book->cover)
                                    <img src="{{ asset('storage/' . $book->cover) }}"
                                        class="w-full h-full object-cover rounded shadow 
                   transition duration-300 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-gray-200 rounded flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-width="2"
                                                d="M12 6l-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h5l2-2m0-12l2-2h5a2 2 0 012 2v12a2 2 0 01-2 2h-5l-2-2" />
                                        </svg>
                                    </div>
                                @endif

                                <!-- overlay -->
                                <div
                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 
        transition flex items-center justify-center rounded">

                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                               c4.477 0 8.268 2.943 9.542 7
                               -1.274 4.057-5.065 7-9.542 7
                               -4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>

                                </div>
                            </div>

                            <div>
                                <p class="font-semibold text-gray-800">
                                    {{ $book->title }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    ISBN: {{ $book->isbn ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <!-- AUTHOR -->
                        <td class="p-4 text-gray-600">
                            {{ $book->author }}
                        </td>

                        <!-- STOCK -->
                        <td class="p-4">
                            <span
                                class="px-2 py-1 text-xs rounded-full
                            {{ $book->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $book->stock }}
                            </span>
                        </td>

                        <!-- CATEGORY -->
                        <td class="p-4">
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">
                                {{ $book->category->name ?? '-' }}
                            </span>
                        </td>

                        <!-- ACTION -->
                        <td class="p-4">
                            <div class="flex justify-center gap-2">

                                <!-- EDIT -->
                                <a href="{{ route('admin.books.edit', $book->id) }}"
                                    class="p-2 bg-yellow-100 text-yellow-600 rounded hover:bg-yellow-200">

                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="2" d="M11 5h2m-1 0v14m-7-7h14" />
                                    </svg>
                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus buku ini?')">
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
                        <td colspan="5" class="p-6 text-center text-gray-400">
                            No books found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <!-- 📄 PAGINATION -->
    <div class="mt-6">
        {{ $books->withQueryString()->links() }}
    </div>

    <!-- 📸 COVER MODAL -->
    <div id="coverModal"
        class="fixed inset-0 bg-black/70 flex items-center justify-center
    opacity-0 pointer-events-none transition duration-300 z-50">

        <!-- CLOSE BUTTON -->
        <button onclick="closeCoverModal()" class="absolute top-6 right-6 text-white text-2xl">
            ✕
        </button>

        <!-- IMAGE -->
        <img id="coverModalImage"
            class="max-w-[90%] max-h-[90%] rounded-xl shadow-xl
        transform scale-95 opacity-0 transition duration-300">
    </div>

    <script>
        function openCoverModal(src) {
            const modal = document.getElementById('coverModal');
            const img = document.getElementById('coverModalImage');

            img.src = src;

            modal.classList.remove('opacity-0', 'pointer-events-none');
            img.classList.remove('scale-95', 'opacity-0');

            img.classList.add('scale-100', 'opacity-100');
        }

        function closeCoverModal() {
            const modal = document.getElementById('coverModal');
            const img = document.getElementById('coverModalImage');

            modal.classList.add('opacity-0', 'pointer-events-none');
            img.classList.add('scale-95', 'opacity-0');
        }

        // klik luar = close
        document.getElementById('coverModal').addEventListener('click', function(e) {
            if (e.target.id === 'coverModal') {
                closeCoverModal();
            }
        });

        // ESC = close
        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") {
                closeCoverModal();
            }
        });
    </script>
@endsection
