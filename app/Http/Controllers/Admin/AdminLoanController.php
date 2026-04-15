<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;

class AdminLoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['user', 'book'])->latest()->get();

        return view('admin.loans.index', compact('loans'));
    }

    public function approve(Loan $loan)
    {
        $loan->update([
            'status' => 'approved',
            'loan_date' => now(),
            'due_date' => now()->addDays(7),
        ]);

        return back()->with('success', 'Peminjaman disetujui!');
    }

    public function reject(Loan $loan)
    {
        $loan->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Peminjaman ditolak!');
    }

    public function approveReturn(Loan $loan)
    {
        $loan->update([
            'status' => 'returned',
            'return_date' => now(),
        ]);

        return back()->with('success', 'Pengembalian disetujui!');
    }
}
