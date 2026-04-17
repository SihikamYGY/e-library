@extends('layouts.admin')

@section('content')

<div class="max-w-2xl mx-auto">

    <h1 class="text-2xl font-semibold text-gray-800 mb-6">
        Add New Book
    </h1>

    <div class="bg-white p-6 rounded-xl shadow-sm">

        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- INPUT STYLE --}}
            @php
                $inputClass = "w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none";
            @endphp

            <div class="grid gap-4">

                <input type="text" name="title" placeholder="Title"
                    value="{{ old('title') }}" class="{{ $inputClass }}">

                <input type="text" name="author" placeholder="Author"
                    value="{{ old('author') }}" class="{{ $inputClass }}">

                <input type="text" name="isbn" placeholder="ISBN"
                    value="{{ old('isbn') }}" class="{{ $inputClass }}">

                <input type="text" name="publisher" placeholder="Publisher"
                    value="{{ old('publisher') }}" class="{{ $inputClass }}">

                <input type="number" name="stock" placeholder="Stock"
                    value="{{ old('stock') }}" class="{{ $inputClass }}">

                <select name="category_id" class="{{ $inputClass }}">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                {{-- COVER --}}
                <div>
                    <input type="file" id="coverInput" name="cover" class="{{ $inputClass }}">

                    <img id="previewImage"
                        class="mt-3 w-24 h-32 object-cover rounded-lg hidden">
                </div>

            </div>

            <div class="flex justify-between mt-6">

                <a href="{{ route('admin.books.index') }}"
                    class="text-gray-500 hover:text-gray-700">
                    ← Back
                </a>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    Save
                </button>

            </div>

        </form>
    </div>
</div>

<script>
    const input = document.getElementById('coverInput');
    const preview = document.getElementById('previewImage');

    input.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        }
    });
</script>

@endsection