<nav class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

        <a href="{{ route('home') }}" class="font-semibold text-lg">
            E-Library
        </a>

        <div class="flex items-center gap-6 text-sm">

            <a href="{{ route('home') }}" class="text-gray-600 hover:text-black">Home</a>
            <a href="{{ route('books.index') }}" class="text-gray-600 hover:text-black">Books</a>
            <a href="{{ route('syarat') }}" class="text-gray-600 hover:text-black">Syarat</a>

            @auth
                <a href="{{ route('loans.my') }}" class="text-gray-600 hover:text-black">
                    My Loans
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="border px-3 py-1 rounded text-sm">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="bg-black text-white px-3 py-1 rounded text-sm">
                    Login
                </a>
            @endauth

        </div>
    </div>
</nav>
