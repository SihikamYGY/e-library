@extends('layouts.user')

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-8">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold">My Loans</h1>

            <a href="{{ route('books.index') }}" class="text-sm text-gray-500 hover:text-black transition">
                Browse Books →
            </a>
        </div>

        {{-- LIST --}}
        <div class="space-y-4">

            @forelse($loans as $loan)
                @php
                    $isOverdue = $loan->due_date && now()->gt($loan->due_date) && $loan->status === 'approved';
                @endphp

                <div class="bg-white rounded-xl shadow-sm p-4 flex gap-5 items-center hover:shadow-md transition">

                    {{-- COVER --}}
                    <div class="w-16 h-24 shrink-0 rounded-md overflow-hidden bg-gray-100">
                        @if ($loan->book->cover)
                            <img src="{{ asset('storage/' . $loan->book->cover) }}" class="w-full h-full object-cover">
                        @endif
                    </div>

                    {{-- INFO --}}
                    <div class="flex-1 min-w-0">

                        <h2 class="text-sm font-semibold truncate">
                            {{ $loan->book->title }}
                        </h2>

                        <p class="text-xs text-gray-500 mb-2">
                            {{ $loan->book->author }}
                        </p>

                        {{-- BADGES --}}
                        <div class="flex flex-wrap gap-2 text-[11px]">

                            {{-- STATUS --}}
                            <span
                                class="px-2 py-1 rounded-full
                                @if ($loan->status === 'pending') bg-yellow-100 text-yellow-700
                                @elseif($loan->status === 'approved') bg-green-100 text-green-700
                                @elseif($loan->status === 'pending_return') bg-blue-100 text-blue-700
                                @elseif($loan->status === 'returned') bg-gray-200 text-gray-600
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst(str_replace('_', ' ', $loan->status)) }}
                            </span>

                            {{-- DUE --}}
                            @if ($loan->due_date)
                                <span
                                    class="px-2 py-1 rounded-full
                                    {{ $isOverdue ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600' }}">
                                    Due {{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}
                                </span>
                            @endif

                            {{-- OVERDUE --}}
                            @if ($isOverdue)
                                <span class="px-2 py-1 rounded-full bg-red-500 text-white">
                                    Overdue
                                </span>
                            @endif

                        </div>

                    </div>

                    {{-- RIGHT --}}
                    <div class="text-right shrink-0">

                        <p class="text-[11px] text-gray-400">Fine</p>

                        <p
                            class="text-sm font-semibold mb-2
                            {{ $loan->fine > 0 ? 'text-red-600' : 'text-gray-800' }}">
                            Rp {{ number_format($loan->fine) }}
                        </p>

                        {{-- ACTION --}}
                        @if ($loan->status === 'approved')
                            <form action="{{ route('loans.return', $loan->id) }}" method="POST">
                                @csrf
                                <button class="bg-black hover:opacity-90 text-white text-xs px-3 py-1.5 rounded">
                                    Return
                                </button>
                            </form>
                        @elseif($loan->status === 'pending_return')
                            <span class="text-xs text-gray-400">
                                Waiting approval
                            </span>
                        @endif

                    </div>

                </div>

            @empty

                {{-- EMPTY --}}
                <div class="bg-white rounded-xl shadow-sm p-8 text-center">

                    <p class="text-gray-500 text-sm mb-4">
                        Kamu belum meminjam buku
                    </p>

                    <a href="{{ route('books.index') }}"
                        class="inline-block bg-black text-white px-5 py-2 rounded text-sm">
                        Browse Books
                    </a>

                </div>
            @endforelse

        </div>

    </section>
@endsection
