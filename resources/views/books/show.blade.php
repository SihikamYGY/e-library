@extends('layouts.user')

@section('content')
    <div class="grid md:grid-cols-3 gap-6">

        {{-- LEFT: COVER --}}
        <div class="bg-white p-4 rounded-xl shadow-sm">
            <div class="h-64 bg-gray-200 rounded"></div>
        </div>

        {{-- RIGHT: INFO --}}
        <div class="md:col-span-2 bg-white p-6 rounded-xl shadow-sm">

            <h1 class="text-xl font-semibold mb-2">
                {{ $book->title }}
            </h1>

            <p class="text-gray-500 text-sm mb-4">
                by {{ $book->author }}
            </p>

            <div class="grid grid-cols-2 gap-4 text-sm mb-4">

                <div>
                    <span class="text-gray-500">Category</span>
                    <p class="font-medium">
                        {{ $book->category->name ?? '-' }}
                    </p>
                </div>

                <div>
                    <span class="text-gray-500">Stock</span>
                    <p class="font-medium">
                        {{ $book->stock }}
                    </p>
                </div>

            </div>

            {{-- DUMMY SINOPSIS --}}
            <div class="mb-6">
                <h2 class="text-sm font-semibold mb-1">Synopsis</h2>
                <p class="text-gray-500 text-sm leading-relaxed">
                    This is a placeholder synopsis for the book. The actual synopsis
                    will be added later when the database structure is updated.
                </p>
            </div>

            {{-- BUTTON --}}
            @auth
                @if ($book->stock > 0)
                    <form action="{{ route('loans.store', $book->id) }}" method="POST">
                        @csrf
                        <button class="bg-black text-white px-4 py-2 rounded text-sm">
                            Borrow Book
                        </button>
                    </form>
                @else
                    <button class="bg-gray-300 text-gray-500 px-4 py-2 rounded text-sm cursor-not-allowed">
                        Out of Stock
                    </button>
                @endif
            @else
                <button onclick="alert('Login dulu buat pinjam buku')" class="bg-black text-white px-4 py-2 rounded text-sm">
                    Borrow Book
                </button>
            @endauth

        </div>

    </div>
@endsection
