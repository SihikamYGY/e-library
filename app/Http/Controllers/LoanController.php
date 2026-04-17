<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;

class LoanController extends Controller
{
    public function store(Book $book)
    {
        $user = auth()->user();

        // 🚫 STOCK
        if ($book->stock <= 0) {
            return back()->with('error', 'Stock buku habis!');
        }

        // 🔥 BLACKLIST CHECK
        $this->checkBlacklist($user);

        if ($user->is_blacklisted) {
            return back()->with('error', 'Kamu diblacklist karena telat!');
        }

        // 📚 MAX LOAN = 3
        $activeLoans = Loan::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved', 'pending_return'])
            ->count();

        if ($activeLoans >= 3) {
            return back()->with('error', 'Maksimal 3 buku!');
        }

        // ❌ SAME BOOK
        $alreadyBorrowed = Loan::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($alreadyBorrowed) {
            return back()->with('error', 'Kamu sudah meminjam buku ini!');
        }

        // ✅ CREATE
        Loan::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Request dikirim!');
    }

    public function returnRequest(Loan $loan)
    {
        // 🔒 SECURITY
        if ($loan->user_id !== auth()->id()) {
            abort(403);
        }

        // ❌ Biar ga spam
        if ($loan->status !== 'approved') {
            return back()->with('error', 'Tidak bisa request return!');
        }

        $loan->update([
            'status' => 'pending_return',
        ]);

        return back()->with('success', 'Request pengembalian dikirim!');
    }

    // 🔥 CORE LOGIC BLACKLIST
    public function checkBlacklist($user)
    {
        $hasLateLoan = Loan::where('user_id', $user->id)
            ->where('status', 'approved')
            ->where('due_date', '<', now())
            ->exists();

        // AUTO UPDATE (true / false)
        $user->update([
            'is_blacklisted' => $hasLateLoan,
        ]);
    }

    public function myLoans()
    {
        $user = auth()->user();

        // 🔥 cek blacklist realtime
        $this->checkBlacklist($user);

        $loans = Loan::where('user_id', $user->id)
            ->with('book')
            ->latest()
            ->get();

        return view('loans.index', compact('loans'));
    }
}
