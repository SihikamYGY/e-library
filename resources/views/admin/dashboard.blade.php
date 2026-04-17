@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <h1 class="text-2xl font-semibold text-gray-700 mb-6">Dashboard Overview</h1>

    <!-- 🔥 STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

        <!-- PENDING -->
        <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-yellow-400">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-500">Pending</p>
                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M12 8v4l3 3" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mt-2 counter" data-target="{{ $pending }}">0</h2>
            <p class="text-xs text-yellow-500 mt-1">Waiting approval</p>
        </div>

        <!-- APPROVED -->
        <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-emerald-500">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-500">Approved</p>
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mt-2 counter" data-target="{{ $approved }}">0</h2>
            <p class="text-xs text-emerald-500 mt-1">Active loans</p>
        </div>

        <!-- RETURNED -->
        <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-blue-500">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-500">Returned</p>
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M9 17l-4-4 4-4m6 8l4-4-4-4" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mt-2 counter" data-target="{{ $returned }}">0</h2>
            <p class="text-xs text-blue-500 mt-1">Completed</p>
        </div>

    </div>

    <!-- 🔥 MAIN -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- 📊 STONKS CHART -->
        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">
                Loan Statistics
            </h2>

            <canvas id="loanChart" height="120"></canvas>
        </div>

        <!-- 👤 PROFILE -->
        <div class="bg-white p-6 rounded-xl shadow-sm text-center">

            <div class="w-20 h-20 mx-auto mb-4">
                <img src="{{ auth()->user()->avatar
                    ? asset('storage/' . auth()->user()->avatar)
                    : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                    class="w-full h-full object-cover rounded-full border">
            </div>

            <h3 class="font-semibold text-gray-700 text-lg">
                {{ auth()->user()->name }}
            </h3>

            <p class="text-sm text-gray-500 mb-4">Admin</p>

            <a href="{{ route('profile.edit') }}" class="text-sm text-blue-500 hover:underline">
                Edit Profile
            </a>

        </div>

    </div>

    <!-- 🚫 BLACKLIST -->
    <div class="mt-8 bg-white p-6 rounded-xl shadow-sm">

        <h2 class="text-lg font-semibold text-gray-700 mb-4">
            Blacklisted Users
        </h2>

        @forelse($blacklistedUsers as $user)
            <div class="flex justify-between items-center border-b py-2">

                <div>
                    <p class="font-medium text-gray-700">{{ $user->name }}</p>
                    <p class="text-xs text-red-500">Overdue</p>
                </div>

                <form action="{{ route('admin.unblacklist', $user->id) }}" method="POST">
                    @csrf
                    <button class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">
                        Unblacklist
                    </button>
                </form>

            </div>
        @empty
            <p class="text-sm text-gray-400">No blacklisted users</p>
        @endforelse

    </div>

    <!-- 📊 CHART -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // counter animation
        const counters = document.querySelectorAll('.counter');

        counters.forEach(counter => {
            const update = () => {
                const target = +counter.getAttribute('data-target');
                const current = +counter.innerText;

                const increment = target / 20;

                if (current < target) {
                    counter.innerText = Math.ceil(current + increment);
                    setTimeout(update, 30);
                } else {
                    counter.innerText = target;
                }
            };

            update();
        });


        // chart gradient
        const ctx = document.getElementById('loanChart').getContext('2d');

        // gradient
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, "rgba(99,102,241,0.4)");
        gradient.addColorStop(1, "rgba(99,102,241,0)");

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Pending', 'Approved', 'Returned'],
                datasets: [{
                    data: [{{ $pending }}, {{ $approved }}, {{ $returned }}],
                    borderColor: '#6366f1',
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: '#6366f1'
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endsection
