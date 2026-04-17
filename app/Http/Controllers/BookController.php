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
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | 1. CONTENT BASED (category + author)
        |--------------------------------------------------------------------------
        */
        $contentBased = Book::where('id', '!=', $book->id)
            ->where(function ($q) use ($book) {
                $q->where('category_id', $book->category_id)
                    ->orWhere('author', $book->author);
            })
            ->withCount('loans')
            ->limit(8)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | 2. COLLABORATIVE FILTERING (users who borrowed this book)
        |--------------------------------------------------------------------------
        */
        $collaborative = Book::whereIn('id', function ($q) use ($book) {
            $q->select('book_id')
                ->from('loans')
                ->whereIn('user_id', function ($q2) use ($book) {
                    $q2->select('user_id')
                        ->from('loans')
                        ->where('book_id', $book->id);
                })
                ->where('book_id', '!=', $book->id);
        })
            ->withCount('loans')
            ->limit(8)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | 3. TRENDING (global most borrowed)
        |--------------------------------------------------------------------------
        */
        $trending = Book::withCount('loans')
            ->orderByDesc('loans_count')
            ->limit(8)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | 4. MERGE + DEDUP + PRIORITY
        |--------------------------------------------------------------------------
        */
        $recommendedBooks = $contentBased
            ->merge($collaborative)
            ->merge($trending)
            ->unique('id')
            ->where('id', '!=', $book->id)
            ->take(10);

        return view('books.show', compact('book', 'recommendedBooks'));
    }
}
