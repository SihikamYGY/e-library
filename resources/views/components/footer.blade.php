<footer class="bg-white border-t mt-16">

    <div class="max-w-7xl mx-auto px-4 py-12 grid md:grid-cols-3 gap-10 text-base">

        {{-- BRAND --}}
        <div>
            <h3 class="font-semibold text-lg mb-3">KamiPerpus</h3>
            <p class="text-gray-500 leading-relaxed">
                Platform perpustakaan digital untuk memudahkan pencarian dan
                peminjaman buku secara online dengan sistem yang sederhana dan efisien.
            </p>
        </div>

        {{-- NAV --}}
        <div>
            <h3 class="font-semibold text-lg mb-3">Menu</h3>
            <ul class="space-y-2 text-gray-500">

                <li>
                    <a href="{{ route('home') }}" class="hover:text-black transition">
                        Home
                    </a>
                </li>

                <li>
                    <a href="{{ route('books.index') }}" class="hover:text-black transition">
                        Books
                    </a>
                </li>

                <li>
                    <a href="{{ route('syarat') }}" class="hover:text-black transition">
                        Syarat
                    </a>
                </li>

            </ul>
        </div>

        {{-- CONTACT --}}
        <div>
            <h3 class="font-semibold text-lg mb-3">Contact</h3>
            <ul class="space-y-2 text-gray-500">
                <li>Email: kamiperpus@email.com</li>
                <li>Instagram: @kamiperpus</li>
                <li>Phone: 08xxxxxxx</li>
            </ul>
        </div>

    </div>

    {{-- COPYRIGHT --}}
    <div class="border-t text-center text-sm text-gray-500 py-4">
        © {{ date('Y') }} KamiPerpus. All rights reserved.
    </div>

</footer>
