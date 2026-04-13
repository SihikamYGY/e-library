@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">
            ✏️ Edit Book
        </h1>

        <div class="bg-white shadow rounded-lg p-6">

            <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Title
                    </label>
                    <input type="text" name="title" value="{{ $book->title }}"
                        class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                {{-- Author --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Author
                    </label>
                    <input type="text" name="author" value="{{ $book->author }}"
                        class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                {{-- Stock --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Stock
                    </label>
                    <input type="number" name="stock" value="{{ $book->stock }}"
                        class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                {{-- Categories --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Category</label>

                    <select name="category_id" class="w-full border p-2 rounded">

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- Cover --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Cover
                    </label>
                    <input type="file" name="cover" class="w-full border p-2 rounded">
                </div>

                {{-- Buttons --}}
                <div class="flex justify-between items-center mt-6">

                    <a href="{{ route('admin.books.index') }}" class="text-gray-500 hover:text-gray-700">
                        ← Back
                    </a>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                        Update Book
                    </button>

                </div>

            </form>

        </div>
    </div>
@endsection
