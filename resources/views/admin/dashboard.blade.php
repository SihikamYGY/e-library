@extends('layouts.admin')
@section('content')
    <h1 class="text-2xl font-bold mb-5">Dashboard</h1>

    <div class="grid grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <p>Total Books</p>
            <h2 class="text-xl">{{ $books }}</h2>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p>Total Categories</p>
            <h2 class="text-xl">{{ $categories }}</h2>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p>Total Users</p>
            <h2 class="text-xl">{{ $users }}</h2>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p>Total Loans</p>
            <h2 class="text-xl">{{ $loans }}</h2>
        </div>
    </div>
@endsection