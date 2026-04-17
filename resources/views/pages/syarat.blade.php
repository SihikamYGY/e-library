@extends('layouts.user')

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-10">

        {{-- HEADER --}}
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            <div>
                <h1 class="text-3xl md:text-4xl font-semibold mb-2">
                    Syarat & Ketentuan
                </h1>
                <p class="text-gray-500 text-base md:text-lg">
                    Aturan penggunaan sistem peminjaman buku KamiPerpus
                </p>
            </div>

            {{-- IMAGE --}}
            <div class="w-full md:w-[280px]">
                <img src="{{ asset('images/books2.jpg') }}" class="w-full h-auto object-contain opacity-90">
            </div>

        </div>

        {{-- GRID CONTENT --}}
        <div class="grid md:grid-cols-2 gap-6">

            {{-- PEMINJAMAN --}}
            <div class="bg-white border rounded-xl p-6 hover:shadow-sm transition">

                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" />
                    </svg>

                    <h2 class="text-xl font-semibold">Peminjaman Buku</h2>
                </div>

                <ul class="space-y-3 text-gray-600 text-base leading-relaxed">
                    <li>Setiap pengguna dapat meminjam maksimal <b>3 buku</b> sekaligus.</li>
                    <li>Peminjaman harus disetujui oleh admin terlebih dahulu.</li>
                    <li>Buku hanya dapat dipinjam jika stok tersedia.</li>
                    <li>Tidak boleh meminjam buku yang sama dalam waktu bersamaan.</li>
                </ul>
            </div>

            {{-- DURASI --}}
            <div class="bg-white border rounded-xl p-6 hover:shadow-sm transition">

                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 6v6l4 2" />
                        <circle cx="12" cy="12" r="9" />
                    </svg>

                    <h2 class="text-xl font-semibold">Durasi Peminjaman</h2>
                </div>

                <ul class="space-y-3 text-gray-600 text-base leading-relaxed">
                    <li>Durasi peminjaman adalah <b>7 hari</b> sejak disetujui.</li>
                    <li>Pengembalian wajib dilakukan sebelum atau saat jatuh tempo.</li>
                </ul>
            </div>

            {{-- DENDA --}}
            <div class="bg-white border rounded-xl p-6 hover:shadow-sm transition">

                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 8v4l3 3" />
                        <circle cx="12" cy="12" r="9" />
                    </svg>

                    <h2 class="text-xl font-semibold">Denda Keterlambatan</h2>
                </div>

                <ul class="space-y-3 text-gray-600 text-base leading-relaxed">
                    <li>Denda sebesar <b>Rp 2.000 / hari</b> keterlambatan.</li>
                    <li>Denda dihitung otomatis oleh sistem.</li>
                    <li>Semakin lama terlambat, semakin besar total denda.</li>
                </ul>
            </div>

            {{-- PENGEMBALIAN --}}
            <div class="bg-white border rounded-xl p-6 hover:shadow-sm transition">

                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M4 4v16h16" />
                        <path d="M8 14l4-4 4 4" />
                    </svg>

                    <h2 class="text-xl font-semibold">Pengembalian Buku</h2>
                </div>

                <ul class="space-y-3 text-gray-600 text-base leading-relaxed">
                    <li>Pengembalian dilakukan melalui sistem.</li>
                    <li>Harus menunggu persetujuan admin.</li>
                </ul>
            </div>

            {{-- BLACKLIST (FULL WIDTH) --}}
            <div class="md:col-span-2 bg-white border rounded-xl p-6 hover:shadow-sm transition">

                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 2l7 4v6c0 5-3 9-7 10-4-1-7-5-7-10V6l7-4z" />
                    </svg>

                    <h2 class="text-xl font-semibold">Blacklist</h2>
                </div>

                <ul class="space-y-3 text-gray-600 text-base leading-relaxed">
                    <li>User dengan keterlambatan aktif akan masuk blacklist otomatis.</li>
                    <li>User blacklist tidak bisa meminjam buku.</li>
                    <li>Status akan otomatis pulih jika semua kewajiban selesai.</li>
                </ul>
            </div>

        </div>

    </section>
@endsection
