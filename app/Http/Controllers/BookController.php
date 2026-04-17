<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    // 📚 Catalog
    public function index()
    {
        $query = Book::with('category');

        // search title
        if (request('search')) {
            $query->where('title', 'like', '%'.request('search').'%');
        }

        // category
        if (request('category')) {
            $query->where('category_id', request('category'));
        }

        // author
        if (request('author')) {
            $query->where('author', request('author'));
        }

        $books = $query->latest()->paginate(12)->withQueryString();

        $categories = Category::all();
        $authors = Book::select('author')->distinct()->pluck('author');

        return view('books.index', compact('books', 'categories', 'authors'));
    }

    // 📖 Detail
    public function show(Book $book)
    {
        $book->load('category');

        return view('books.show', compact('book'));
    }
}
