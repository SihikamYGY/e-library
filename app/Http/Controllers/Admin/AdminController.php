<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'books' => Book::count(),
            'categories' => Category::count(),
            'users' => User::count(),
            'loans' => Loan::count(),

            'pending' => Loan::where('status', 'pending')->count(),
            'approved' => Loan::where('status', 'approved')->count(),
            'returned' => Loan::where('status', 'returned')->count(),

            'blacklistedUsers' => User::where('is_blacklisted', true)->get(),
        ]);
    }

    public function unblacklist(User $user)
    {
        $user->update([
            'is_blacklisted' => false,
        ]);

        return back()->with('success', 'User berhasil di-unblacklist!');
    }
}
