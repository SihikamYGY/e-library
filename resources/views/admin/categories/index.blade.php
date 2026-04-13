@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">📂 Categories</h1>

    <a href="{{ route('admin.categories.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow">
        + Add Category
    </a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 text-sm text-gray-600 uppercase">
            <tr>
                <th class="p-3">Name</th>
                <th class="p-3 text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($categories as $category)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-3">{{ $category->name }}</td>

                <td class="p-3">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                           class="bg-yellow-400 text-white px-3 py-1 rounded text-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin?')">
                            @csrf
                            @method('DELETE')

                            <button class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="p-4 text-center text-gray-500">
                    Belum ada kategori
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection