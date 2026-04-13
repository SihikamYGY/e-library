@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Books</h1>

        <a href="{{ route('admin.books.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            + Add Book
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                <tr>
                    <th class="p-3">Cover</th>
                    <th class="p-3">Title</th>
                    <th class="p-3">Author</th>
                    <th class="p-3">Stock</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($books as $book)
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="p-3">
                            @if ($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}" class="w-16 h-20 object-cover rounded">
                            @else
                                <span class="text-gray-400 text-sm">No Image</span>
                            @endif
                        </td>
                        <td class="p-3 font-medium text-gray-800">
                            {{ $book->title }}
                        </td>

                        <td class="p-3 text-gray-600">
                            {{ $book->author }}
                        </td>

                        <td class="p-3">
                            <span
                                class="px-2 py-1 text-sm rounded 
                        {{ $book->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $book->stock }}
                            </span>
                        </td>

                        <td class="p-3">
                            <div class="flex justify-center gap-2">

                                {{-- Edit --}}
                                <a href="{{ route('admin.books.edit', $book->id) }}"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                    Edit
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin mau hapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-5 text-center text-gray-500">
                            Belum ada buku 😢
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
