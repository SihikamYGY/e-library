@extends('layouts.user')

@section('content')
    {{-- HERO --}}
    <section class="min-h-[85vh] flex items-center">

        <div class="max-w-7xl mx-auto px-4 w-full">

            <div class="grid md:grid-cols-2 gap-12 items-center mx-5">

                {{-- TEXT --}}
                <div class="max-w-lg fade-up">

                    <h1 class="text-4xl md:text-5xl font-semibold leading-tight mb-6">
                        Discover Books <br>
                        Without Limits
                    </h1>

                    <p class="text-gray-500 mb-8 text-base md:text-lg">
                        Jelajahi berbagai buku dari berbagai kategori dan pinjam dengan mudah.
                    </p>

                    <div class="flex gap-4 mb-10">
                        <a href="{{ route('books.index') }}"
                            class="bg-black text-white px-6 py-3 rounded text-sm hover:opacity-90 transition">
                            Browse Books
                        </a>

                        <a href="{{ route('syarat') }}"
                            class="border px-6 py-3 rounded text-sm hover:bg-gray-100 transition">
                            Borrow Rules
                        </a>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="overflow-hidden border-t pt-4">
                        <div class="flex gap-4 animate-marquee whitespace-nowrap text-base text-gray-500">

                            @foreach ($categories as $category)
                                <span class="px-4 py-1.5 border rounded-full">
                                    {{ $category->name }}
                                </span>
                            @endforeach

                            @foreach ($categories as $category)
                                <span class="px-4 py-1.5 border rounded-full">
                                    {{ $category->name }}
                                </span>
                            @endforeach

                        </div>
                    </div>

                </div>

                {{-- IMAGE --}}
                <div class="flex justify-center md:justify-end fade-up delay-2">
                    <img src="{{ asset('images/book-philosophy.svg') }}"
                        class="w-full max-w-md h-[340px] object-contain hover:scale-105 transition duration-300">
                </div>

            </div>

        </div>

    </section>


    {{-- ABOUT --}}
    <section class="mb-24 mt-16 fade-up">

        <div class="max-w-7xl mx-auto px-4">

            <div class="grid md:grid-cols-2 gap-12 items-center">

                {{-- IMAGE --}}
                <div class="fade-up delay-1">
                    <img src="{{ asset('images/libray.jpg') }}" class="w-full h-[400px] object-cover rounded-xl shadow-sm">
                </div>

                {{-- TEXT --}}
                <div class="fade-up delay-2">

                    <h2 class="text-3xl font-semibold mb-5">
                        About KamiPerpus
                    </h2>

                    <p class="text-gray-500 mb-6">
                        Platform perpustakaan digital untuk memudahkan akses dan peminjaman buku.
                    </p>

                    <div class="grid grid-cols-2 gap-4">

                        @foreach ([
            'Easy Borrow' => 'Pinjam cepat',
            'Smart System' => 'Auto limit & denda',
            'Organized' => 'Kategori rapi',
            'Accessible' => 'Akses kapan saja',
        ] as $title => $desc)
                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition hover:-translate-y-1">

                                <p class="font-medium">{{ $title }}</p>
                                <p class="text-gray-500 text-sm">{{ $desc }}</p>

                            </div>
                        @endforeach

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- CATALOG --}}
    <section class="mb-20">

        <div class="flex justify-between items-center mb-6 fade-up">
            <h2 class="text-2xl font-semibold">Katalog Buku</h2>

            <a href="{{ route('books.index') }}" class="text-sm text-gray-500">
                Lihat Semua →
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

            @foreach ($books as $index => $book)
                <div class="bg-white rounded-xl shadow-sm p-4 
                        hover:-translate-y-2 hover:shadow-md 
                        transition duration-300 fade-up"
                    style="animation-delay: {{ $index * 0.1 }}s">

                    <div class="w-full aspect-[3/4] mb-3">
                        @if ($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-full object-cover rounded">
                        @else
                            <div class="w-full h-full bg-gray-200 rounded"></div>
                        @endif
                    </div>

                    <h3 class="text-base font-semibold mb-1 line-clamp-2">
                        {{ $book->title }}
                    </h3>

                    <p class="text-sm text-gray-500 mb-3">
                        {{ $book->author }}
                    </p>

                    <a href="{{ route('books.show', $book->id) }}"
                        class="block text-center bg-black text-white text-sm py-2 rounded hover:opacity-90">
                        Detail
                    </a>

                </div>
            @endforeach

        </div>

    </section>


    {{-- CONTACT --}}
    <section class="mb-24 fade-up">

        <div class="max-w-7xl mx-auto px-4">

            <div class="bg-white rounded-xl shadow-sm overflow-hidden grid md:grid-cols-2">

                {{-- LEFT --}}
                <div class="p-8">

                    <h2 class="text-2xl font-semibold mb-4">
                        Contact Us
                    </h2>

                    <p class="text-gray-500 mb-8">
                        Hubungi kami jika ada pertanyaan.
                    </p>

                    <div class="space-y-4 mb-8 text-sm">

                        <p>📧 kamiperpus@email.com</p>
                        <p>📷 @kamiperpus</p>
                        <p>📞 08xxxxxxx</p>
                        <p>📍 Bandung</p>

                    </div>

                    <form class="space-y-4">

                        <input type="text" placeholder="Nama"
                            class="w-full border px-4 py-3 rounded focus:ring-1 focus:ring-black">

                        <input type="email" placeholder="Email"
                            class="w-full border px-4 py-3 rounded focus:ring-1 focus:ring-black">

                        <textarea placeholder="Pesan" class="w-full border px-4 py-3 rounded h-28 focus:ring-1 focus:ring-black"></textarea>

                        <button class="w-full bg-black text-white py-3 rounded hover:opacity-90">
                            Kirim Pesan
                        </button>

                    </form>

                </div>

                {{-- MAP --}}
                <div class="h-[420px] md:h-auto">
                    <iframe src="https://maps.google.com/maps?q=bandung&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        class="w-full h-full border-0">
                    </iframe>
                </div>

            </div>

        </div>

    </section>
@endsection
