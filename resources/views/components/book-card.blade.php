<div class="bg-white rounded-xl shadow-sm p-4 h-full flex flex-col">

    <div class="h-40 bg-gray-200 rounded mb-3"></div>

    <h3 class="font-semibold text-sm mb-1">
        {{ $book->title }}
    </h3>

    <p class="text-xs text-gray-500 mb-2">
        {{ $book->author }}
    </p>

    <span class="text-xs text-gray-600 mb-3">
        Stock: {{ $book->stock }}
    </span>

    <a href="{{ route('books.show', $book->id) }}"
       class="mt-auto text-center bg-black text-white text-sm py-1 rounded">
        Detail
    </a>

</div>