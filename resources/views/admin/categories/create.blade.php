@extends('layouts.admin')

@section('content')

<div class="max-w-xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">➕ Add Category</h1>

    <div class="bg-white p-6 rounded-lg shadow">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium">Category Name</label>
                <input type="text" name="name"
                       class="w-full border p-2 rounded"
                       value="{{ old('name') }}">

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.categories.index') }}">← Back</a>

                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Save
                </button>
            </div>

        </form>
    </div>
</div>

@endsection