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
        ]);
    }
}
