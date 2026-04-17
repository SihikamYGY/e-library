@extends('layouts.user')

@section('content')
    <h1 class="text-lg font-semibold mb-4">Katalog Buku</h1>

    {{-- SEARCH --}}
    <form method="GET" class="mb-4 flex gap-2">

        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul buku..."
            class="border px-3 py-2 rounded text-sm w-full md:w-80">

        {{-- KEEP FILTER --}}
        <input type="hidden" name="category" value="{{ request('category') }}">
        <input type="hidden" name="author" value="{{ request('author') }}">

        <button class="bg-black text-white px-4 py-2 rounded text-sm">
            Search
        </button>

        <a href="{{ route('books.index') }}" class="px-3 py-2 text-sm border rounded">
            Reset
        </a>
    </form>


    {{-- CATEGORY BUTTONS --}}
    <div class="mb-4 flex flex-wrap gap-2">

        {{-- ALL --}}
        <a href="{{ route('books.index', array_merge(request()->except('category'), ['category' => null])) }}"
            class="px-3 py-1 text-xs rounded border
       {{ request('category') ? 'text-gray-500' : 'bg-black text-white' }}">
            Semua
        </a>

        @foreach ($categories as $category)
            <a href="{{ route('books.index', array_merge(request()->except('category'), ['category' => $category->id])) }}"
                class="px-3 py-1 text-xs rounded border
           {{ request('category') == $category->id ? 'bg-black text-white' : 'text-gray-600' }}">
                {{ $category->name }}
            </a>
        @endforeach

    </div>


    {{-- AUTHOR BUTTONS --}}
    <div class="mb-6 flex flex-wrap gap-2">

        {{-- ALL --}}
        <a href="{{ route('books.index', array_merge(request()->except('author'), ['author' => null])) }}"
            class="px-3 py-1 text-xs rounded border
       {{ request('author') ? 'text-gray-500' : 'bg-black text-white' }}">
            Semua Author
        </a>

        @foreach ($authors as $author)
            <a href="{{ route('books.index', array_merge(request()->except('author'), ['author' => $author])) }}"
                class="px-3 py-1 text-xs rounded border
           {{ request('author') == $author ? 'bg-black text-white' : 'text-gray-600' }}">
                {{ $author }}
            </a>
        @endforeach

    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

        @forelse($books as $book)
            <div class="bg-white rounded-xl shadow-sm p-4 hover:-translate-y-1 transition">

                {{-- COVER --}}
                <div class="w-full aspect-[3/4] mb-3">
                    @if ($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-full object-cover rounded">
                    @else
                        <div class="w-full h-full bg-gray-200 rounded"></div>
                    @endif
                </div>

                {{-- TITLE --}}
                <h3 class="text-sm font-semibold mb-1 line-clamp-2">
                    {{ $book->title }}
                </h3>

                {{-- AUTHOR --}}
                <p class="text-xs text-gray-500 mb-3">
                    {{ $book->author }}
                </p>

                {{-- BUTTON --}}
                <a href="{{ route('books.show', $book->id) }}"
                    class="block text-center bg-black text-white text-xs py-1.5 rounded">
                    Detail
                </a>

            </div>
        @empty
            <p class="text-gray-500">No books found</p>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $books->links() }}
    </div>
@endsection
