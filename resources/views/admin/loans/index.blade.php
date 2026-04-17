@extends('layouts.admin')

@section('content')

<!-- 🔥 HEADER -->
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">

        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-width="2" d="M12 6v6l4 2M12 2a10 10 0 100 20 10 10 0 000-20z" />
        </svg>

        Loans Management
    </h1>
</div>

<!-- SUCCESS -->
@if (session('success'))
    <div class="px-4 py-3 rounded-lg bg-green-50 text-green-700 text-sm border border-green-100">
        {{ session('success') }}
    </div>
@endif

<!-- 🔎 FILTER -->
<div class="bg-white p-4 rounded-xl shadow-sm flex flex-wrap gap-3 items-center">

    <form method="GET" class="flex flex-wrap gap-3 w-full">

        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Search user or book..."
            class="border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400">

        <select name="status" class="border rounded-lg px-3 py-2 text-sm">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            <option value="pending_return" {{ request('status') == 'pending_return' ? 'selected' : '' }}>Return Request</option>
            <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Returned</option>
        </select>

        <select name="overdue" class="border rounded-lg px-3 py-2 text-sm">
            <option value="">All</option>
            <option value="1" {{ request('overdue') ? 'selected' : '' }}>Overdue Only</option>
        </select>

        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
            Filter
        </button>

        <a href="{{ route('admin.loans.index') }}" class="text-gray-500 text-sm flex items-center">
            Reset
        </a>

    </form>

</div>

<!-- 📊 TABLE -->
<div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">

    <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
            <tr>
                <th class="p-4">User</th>
                <th class="p-4">Book</th>
                <th class="p-4">Status</th>
                <th class="p-4">Loan</th>
                <th class="p-4">Due</th>
                <th class="p-4">Fine</th>
                <th class="p-4 text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($loans as $loan)
                @php
                    $isOverdue = $loan->due_date && $loan->due_date < now() && $loan->status === 'approved';
                @endphp

                <tr class="border-t transition {{ $isOverdue ? 'bg-red-50 hover:bg-red-100' : 'hover:bg-gray-50' }}">

                    <td class="p-4 font-medium text-gray-800">
                        {{ $loan->user->name }}
                    </td>

                    <td class="p-4 text-gray-600">
                        {{ $loan->book->title }}
                    </td>

                    <td class="p-4">
                        @if ($isOverdue)
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">
                                Overdue
                            </span>
                        @else
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'approved' => 'bg-green-100 text-green-700',
                                    'rejected' => 'bg-red-100 text-red-700',
                                    'pending_return' => 'bg-blue-100 text-blue-700',
                                    'returned' => 'bg-gray-200 text-gray-700',
                                ];
                            @endphp

                            <span class="px-2 py-1 rounded text-xs {{ $statusColors[$loan->status] ?? '' }}">
                                {{ str_replace('_', ' ', ucfirst($loan->status)) }}
                            </span>
                        @endif
                    </td>

                    <td class="p-4 text-gray-500">
                        {{ $loan->loan_date ?? '-' }}
                    </td>

                    <td class="p-4 text-gray-500">
                        {{ $loan->due_date ?? '-' }}
                    </td>

                    <td class="p-4 font-semibold text-gray-700">
                        Rp {{ number_format($loan->fine, 0, ',', '.') }}
                    </td>

                    <td class="p-4">
                        <div class="flex justify-center gap-2">

                            @if ($loan->status === 'pending')
                                <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST">
                                    @csrf
                                    <button class="p-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200">
                                        ✓
                                    </button>
                                </form>

                                <form action="{{ route('admin.loans.reject', $loan->id) }}" method="POST">
                                    @csrf
                                    <button class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200">
                                        ✕
                                    </button>
                                </form>
                            @endif

                            @if ($loan->status === 'pending_return')
                                <form action="{{ route('admin.loans.approveReturn', $loan->id) }}" method="POST">
                                    @csrf
                                    <button class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200">
                                        ↩
                                    </button>
                                </form>
                            @endif

                        </div>
                    </td>

                </tr>

            @empty
                <tr>
                    <td colspan="7" class="p-6 text-center text-gray-400">
                        No loans found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

<!-- 📄 PAGINATION -->
<div>
    {{ $loans->links() }}
</div>

@endsection