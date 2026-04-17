@extends('layouts.user')

@section('content')
    {{-- HERO --}}
    <section class="relative mb-10">

        {{-- SLIDE --}}
        <div class="h-[400px] md:h-[500px] rounded-xl overflow-hidden relative">

            {{-- Slide 1 --}}
            <div class="absolute inset-0 bg-gray-300 flex items-center justify-center">
                <p class="text-gray-600">Hero Image 1</p>
            </div>

            {{-- Overlay --}}
            <div class="absolute inset-0 bg-black/40 flex items-center">
                <div class="px-6 md:px-12 text-white max-w-xl">
                    <h1 class="text-3xl md:text-4xl font-semibold mb-3">
                        KamiPerpus
                    </h1>

                    <p class="text-sm md:text-base mb-5 text-gray-200">
                        Platform perpustakaan digital untuk memudahkan peminjaman buku secara online.
                    </p>

                    <a href="{{ route('books.index') }}" class="bg-white text-black px-4 py-2 rounded text-sm">
                        Jelajahi Buku
                    </a>
                </div>
            </div>

        </div>
    </section>


    {{-- ABOUT --}}
    <section class="mb-10">
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h2 class="text-lg font-semibold mb-2">Tentang KamiPerpus</h2>

            <p class="text-gray-500 text-sm leading-relaxed max-w-3xl">
                KamiPerpus adalah platform perpustakaan digital yang dirancang untuk membantu
                pengguna dalam menemukan, meminjam, dan mengelola buku dengan mudah.
                Dengan sistem yang sederhana dan modern, pengguna dapat menikmati pengalaman
                membaca yang lebih efisien.
            </p>
        </div>
    </section>


    {{-- PREVIEW CATALOG --}}
    <section class="mb-10">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Katalog Buku</h2>

            <a href="{{ route('books.index') }}" class="text-sm text-gray-500">
                Lihat Semua →
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach ($books as $book)
                <div class="bg-white rounded-xl shadow-sm p-4 hover:-translate-y-1 transition">

                    {{-- COVER (RASIO BUKU) --}}
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
            @endforeach
        </div>

    </section>


    {{-- CONTACT --}}
    <section class="mb-10">

        <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm">

            <h2 class="text-lg font-semibold mb-6">Contact KamiPerpus</h2>

            <div class="grid md:grid-cols-2 gap-8">

                {{-- LEFT: INFO + LOCATION --}}
                <div>

                    <div class="text-sm text-gray-600 space-y-2 mb-6">
                        <p><span class="font-medium">Email:</span> kamiperpus@email.com</p>
                        <p><span class="font-medium">Instagram:</span> @kamiperpus</p>
                        <p><span class="font-medium">Phone:</span> 08xxxxxxx</p>
                        <p><span class="font-medium">Address:</span> Jl. Perpustakaan No. 123, Indonesia</p>
                    </div>

                    {{-- MAP (Embed Google Maps dummy) --}}
                    <div class="w-full h-56 rounded overflow-hidden">
                        <iframe class="w-full h-full border-0"
                            src="https://maps.google.com/maps?q=Jakarta&t=&z=13&ie=UTF8&iwloc=&output=embed" loading="lazy">
                        </iframe>
                    </div>

                </div>


                {{-- RIGHT: FORM --}}
                <form class="space-y-4">

                    <div>
                        <label class="text-sm font-medium">Name</label>
                        <input type="text"
                            class="w-full mt-1 border rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-black">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Email</label>
                        <input type="email"
                            class="w-full mt-1 border rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-black">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Message</label>
                        <textarea rows="4"
                            class="w-full mt-1 border rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-black"></textarea>
                    </div>

                    <button type="submit" class="bg-black text-white px-4 py-2 rounded text-sm">
                        Send Message
                    </button>

                </form>

            </div>

        </div>

    </section>
@endsection
