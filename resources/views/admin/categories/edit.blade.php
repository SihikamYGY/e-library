@extends('layouts.admin')

@section('content')

<div class="max-w-xl mx-auto">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">
        Edit Category
    </h1>

    <div class="bg-white p-6 rounded-xl shadow-sm">

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- NAME -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Category Name
                </label>

                <input type="text" name="name" value="{{ $category->name }}"
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <!-- BUTTON -->
            <div class="flex justify-between items-center mt-6">

                <a href="{{ route('admin.categories.index') }}"
                    class="text-gray-500 hover:text-gray-700">
                    ← Back
                </a>

                <button
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">
                    Update
                </button>

            </div>

        </form>

    </div>
</div>

@endsection