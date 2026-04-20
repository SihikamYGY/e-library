@extends('layouts.user')

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-10">

        {{-- FLASH MESSAGE --}}
        @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-700 text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-600 text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
                {{ session('error') }}
            </div>
        @endif


        <div class="grid md:grid-cols-3 gap-12">

            {{-- COVER --}}
            <div class="md:col-span-1">
                <div class="sticky top-24">
                    <div class="aspect-[3/4] bg-white rounded-2xl shadow-sm overflow-hidden border">

                        @if ($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                                No Cover
                            </div>
                        @endif

                    </div>
                </div>
            </div>


            {{-- CONTENT --}}
            <div class="md:col-span-2">

                {{-- TITLE --}}
                <h1 class="text-3xl md:text-4xl font-semibold leading-tight mb-2">
                    {{ $book->title }}
                </h1>

                <p class="text-gray-500 text-sm mb-6">
                    by {{ $book->author }}
                </p>

                {{-- META --}}
                <div class="flex flex-wrap gap-2 mb-8 text-xs">

                    <span class="px-3 py-1 bg-gray-100 rounded-full flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 19.5V4.5A1.5 1.5 0 015.5 3h13A1.5 1.5 0 0120 4.5v15" />
                        </svg>
                        {{ $book->category->name ?? 'Uncategorized' }}
                    </span>

                    <span class="px-3 py-1 bg-gray-100 rounded-full flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 6v6l4 2" />
                        </svg>
                        Stock: {{ $book->stock }}
                    </span>

                </div>

                {{-- SYNOPSIS --}}

                <p class="text-sm text-gray-600 leading-relaxed mb-8">
                    {{ $book->synopsis ?? 'No synopsis available.' }}
                </p>

                {{-- INFO BOX --}}
                <div class="bg-gray-50 border rounded-2xl p-5 mb-8 text-sm text-gray-600 space-y-2">

                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 8v4l3 3" />
                            <circle cx="12" cy="12" r="9" />
                        </svg>
                        Loan duration: 7 days
                    </div>

                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 8v4l3 3" />
                            <circle cx="12" cy="12" r="9" />
                        </svg>
                        Max 3 active loans per user
                    </div>

                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 8v4l3 3" />
                            <circle cx="12" cy="12" r="9" />
                        </svg>
                        Late return may incur fine
                    </div>

                </div>

                {{-- ACTION --}}
                <div class="flex gap-3">

                    @auth

                        @if ($book->stock > 0)
                            <form id="borrowForm" action="{{ route('loans.store', $book->id) }}" method="POST">
                                @csrf

                                <button id="borrowBtn"
                                    class="bg-black hover:bg-gray-900 text-white px-6 py-3 rounded-xl text-sm flex items-center gap-2 transition disabled:opacity-60">

                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path d="M12 5v14M5 12h14" />
                                    </svg>

                                    <span id="borrowText">Borrow Book</span>

                                    <svg id="loadingIcon" class="w-4 h-4 hidden animate-spin" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" stroke="white" stroke-width="4"
                                            opacity="0.25" />
                                        <path fill="white" d="M4 12a8 8 0 018-8v8z" />
                                    </svg>

                                </button>
                            </form>
                        @else
                            <button disabled
                                class="bg-gray-100 text-gray-400 px-6 py-3 rounded-xl text-sm flex items-center gap-2">

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 6v6l4 2" />
                                </svg>

                                Out of Stock
                            </button>
                        @endif
                    @else
                        <button onclick="openLoginModal()"
                            class="bg-black text-white px-6 py-3 rounded-xl text-sm flex items-center gap-2">

                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M16 21v-2a4 4 0 00-8 0v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>

                            Login to Borrow
                        </button>

                    @endauth

                    <a href="{{ route('books.index') }}"
                        class="border px-6 py-3 rounded-xl text-sm hover:bg-gray-50 transition">
                        Back
                    </a>

                </div>

            </div>

        </div>
    </section>


    {{-- NETFLIX STYLE RECOMMENDATION (CLEAN UI) --}}
    @if ($recommendedBooks->count())
        <section class="mt-16">

            {{-- HEADER --}}
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold tracking-tight">
                    More like this
                </h2>

                <span class="text-xs text-gray-400 flex items-center gap-1.5">

                    {{-- ICON CLEAN --}}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M12 6v6l4 2"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                    </svg>

                    Recommended for you
                </span>
            </div>

            {{-- LIST --}}
            <div class="flex gap-6 overflow-x-auto pb-4 snap-x snap-mandatory">

                @foreach ($recommendedBooks as $rec)
                    <a href="{{ route('books.show', $rec->id) }}"
                        class="min-w-[260px] md:min-w-[280px] bg-white border rounded-2xl overflow-hidden
                       hover:-translate-y-1 hover:shadow-md transition duration-200 snap-start">

                        {{-- COVER --}}
                        <div class="aspect-[3/4] bg-gray-100">

                            @if ($rec->cover)
                                <img src="{{ asset('storage/' . $rec->cover) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">
                                    No Cover
                                </div>
                            @endif

                        </div>

                        {{-- INFO --}}
                        <div class="p-4">

                            <h3 class="text-base font-semibold line-clamp-2 leading-snug">
                                {{ $rec->title }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $rec->author }}
                            </p>

                            {{-- META --}}
                            <div class="mt-4 flex items-center justify-between text-xs text-gray-400">

                                <span class="truncate max-w-[140px]">
                                    {{ $rec->category->name ?? 'Uncategorized' }}
                                </span>

                                <span class="flex items-center gap-1.5">

                                    {{-- ICON CLEAN --}}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">
                                        <path d="M4 19.5V4.5A1.5 1.5 0 015.5 3h13A1.5 1.5 0 0120 4.5v15" />
                                    </svg>

                                    {{ $rec->loans_count }}
                                </span>

                            </div>

                        </div>

                    </a>
                @endforeach

            </div>

        </section>
    @endif


    <script>
        document.getElementById('borrowForm')?.addEventListener('submit', function() {
            document.getElementById('borrowText').innerText = 'Processing...'
            document.getElementById('loadingIcon').classList.remove('hidden')
            document.getElementById('borrowBtn').disabled = true
        })
    </script>
@endsection
