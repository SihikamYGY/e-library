<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::latest()->take(4)->get();
        $categories = Category::all();

        return view('pages.home', compact('books', 'categories'));
    }
}