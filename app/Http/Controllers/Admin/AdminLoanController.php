<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminLoanController extends Controller
{
    public function index(Request $request)
    {

        $query = Loan::with(['user', 'book']);

        // 🔎 SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('user', function ($q2) use ($request) {
                    $q2->where('name', 'like', '%'.$request->search.'%');
                })
                    ->orWhereHas('book', function ($q2) use ($request) {
                        $q2->where('title', 'like', '%'.$request->search.'%');
                    });
            });
        }

        // STATUS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // OVERDUE
        if ($request->overdue) {
            $query->where('due_date', '<', now())
                ->where('status', 'approved');
        }

        $loans = $query->latest()->paginate(10)->withQueryString();

        return view('admin.loans.index', compact('loans'));
    }

    public function approve(Loan $loan)
    {
        // 🚫 ANTI DOUBLE APPROVE
        if ($loan->status !== 'pending') {
            return back()->with('error', 'Loan sudah diproses!');
        }

        $book = $loan->book;

        // 🚫 STOCK CHECK
        if ($book->stock <= 0) {
            return back()->with('error', 'Stock habis!');
        }

        // 🔥 KURANGI STOCK
        $book->decrement('stock');

        // ✅ UPDATE LOAN
        $loan->update([
            'status' => 'approved',
            'loan_date' => now(),
            'due_date' => now()->addDays(7),
        ]);

        return back()->with('success', 'Peminjaman disetujui!');
    }

    public function approveReturn($id)
    {
        $loan = Loan::findOrFail($id);

        // 🚫 ANTI DOUBLE RETURN
        if ($loan->status !== 'pending_return') {
            return back()->with('error', 'Invalid action!');
        }

        // 🔥 BALIKIN STOCK
        $loan->book->increment('stock');

        // 🔥 RE-CHECK BLACKLIST (JANGAN ASAL FALSE)
        $this->checkBlacklist($loan->user);

        $loan->update([
            'status' => 'returned',
            'return_date' => now(),

            // 🔥 freeze nilai terakhir (biar ga keubah scheduler)
            'fine' => $loan->fine,
        ]);

        return back()->with('success', 'Pengembalian disetujui!');
    }

    public function reject(Loan $loan)
    {
        $loan->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Peminjaman ditolak!');
    }

    public function checkBlacklist($user)
    {
        $hasLateLoan = Loan::where('user_id', $user->id)
            ->where('status', 'approved')
            ->where('due_date', '<', now())
            ->exists();

        $user->update([
            'is_blacklisted' => $hasLateLoan,
        ]);
    }

    public function calculateFine($loan)
    {
        if (! $loan->due_date) {
            return 0;
        }

        if ($loan->status !== 'approved') {
            return 0;
        }

        $today = now()->startOfDay();
        $due = Carbon::parse($loan->due_date)->startOfDay();

        if ($today <= $due) {
            return 0;
        }

        $daysLate = $due->diffInDays($today);

        return $daysLate * 2000; // 💸 progressive fine
    }
}
