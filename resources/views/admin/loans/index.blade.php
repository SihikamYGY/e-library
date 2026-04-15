@extends('layouts.admin')

@section('content')
    <div class="p-6">

        <h1 class="text-2xl font-bold mb-4">📚 Loans Management</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Book</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Loan Date</th>
                        <th class="px-4 py-3">Due Date</th>
                        <th class="px-4 py-3">Fine</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($loans as $loan)
                        <tr class="hover:bg-gray-50">

                            <td class="px-4 py-3 font-medium">
                                {{ $loan->user->name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $loan->book->title }}
                            </td>

                            {{-- STATUS BADGE --}}
                            <td class="px-4 py-3">
                                @if ($loan->status === 'pending')
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Pending</span>
                                @elseif($loan->status === 'approved')
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Approved</span>
                                @elseif($loan->status === 'rejected')
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Rejected</span>
                                @elseif($loan->status === 'pending_return')
                                    <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">Return Request</span>
                                @elseif($loan->status === 'returned')
                                    <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs">Returned</span>
                                @endif
                            </td>

                            <td class="px-4 py-3">
                                {{ $loan->loan_date ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $loan->due_date ?? '-' }}
                            </td>

                            <td class="px-4 py-3 font-semibold">
                                Rp {{ number_format($loan->fine, 0, ',', '.') }}
                            </td>

                            {{-- ACTION --}}
                            <td class="px-4 py-3 space-x-2">

                                {{-- APPROVE --}}
                                @if ($loan->status === 'pending')
                                    <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button
                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs">
                                            Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.loans.reject', $loan->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                            Reject
                                        </button>
                                    </form>
                                @endif

                                {{-- APPROVE RETURN --}}
                                @if ($loan->status === 'pending_return')
                                    <form action="{{ route('admin.loans.approveReturn', $loan->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                            Approve Return
                                        </button>
                                    </form>
                                @endif

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
