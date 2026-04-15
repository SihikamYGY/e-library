@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">
            Add New Book
        </h1>

        <div class="bg-white shadow rounded-lg p-6">

            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Title
                    </label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">

                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Author --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Author
                    </label>
                    <input type="text" name="author" value="{{ old('author') }}"
                        class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">

                    @error('author')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ISBN --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        ISBN
                    </label>
                    <input type="text" name="isbn" value="{{ old('isbn') }}"
                        class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">

                    @error('isbn')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Publisher --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Publisher
                    </label>
                    <input type="text" name="publisher" value="{{ old('publisher') }}"
                        class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">

                    @error('publisher')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Stock --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Stock
                    </label>
                    <input type="number" name="stock" value="{{ old('stock') }}"
                        class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">

                    @error('stock')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Categories --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Category</label>

                    <select name="category_id" class="w-full border p-2 rounded">
                        <option value="">-- Pilih Category --</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Cover Upload --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Cover
                    </label>

                    <input type="file" name="cover" id="coverInput" class="w-full border p-2 rounded cursor-pointer">

                    {{-- Preview --}}
                    <div class="mt-3">
                        <img id="previewImage" class="w-24 h-32 object-cover rounded shadow hidden">
                    </div>

                    @error('cover')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex justify-between items-center mt-6">

                    <a href="{{ route('admin.books.index') }}" class="text-gray-500 hover:text-gray-700">
                        ← Back
                    </a>

                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">
                        Save Book
                    </button>

                </div>

            </form>
        </div>
    </div>

    {{-- JS Preview --}}
    <script>
        const input = document.getElementById('coverInput');
        const preview = document.getElementById('previewImage');

        input.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            }
        });
    </script>
@endsection
