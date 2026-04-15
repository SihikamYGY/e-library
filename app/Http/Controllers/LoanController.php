<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;

class LoanController extends Controller
{
    public function store(Book $book)
    {
        $user = auth()->user();

        // ❌ Cegah pinjam lebih dari 1
        $hasLoan = Loan::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($hasLoan) {
            return back()->with('error', 'Masih ada pinjaman aktif!');
        }

        Loan::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Request dikirim!');
    }

    public function returnRequest(Loan $loan)
    {
        if ($loan->user_id !== auth()->id()) {
            abort(403);
        }

        $loan->update([
            'status' => 'pending_return',
        ]);

        return back()->with('success', 'Request pengembalian dikirim!');
    }
}
