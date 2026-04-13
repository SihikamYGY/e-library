@extends('layouts.admin')

@section('content')

<div class="max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">✏️ Edit Category</h1>

    <div class="bg-white p-6 rounded shadow">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="block mb-2">Name</label>
            <input type="text" name="name"
                   value="{{ $category->name }}"
                   class="w-full border p-2 rounded mb-3">

            <div class="flex justify-between">
                <a href="{{ route('admin.categories.index') }}">← Back</a>

                <button class="bg-green-600 text-white px-4 py-2 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

@endsection