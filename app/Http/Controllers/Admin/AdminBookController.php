<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        // 🔍 Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('author', 'like', '%'.$request->search.'%')
                    ->orWhere('isbn', 'like', '%'.$request->search.'%');
            });
        }

        // 🎯 Filter Category
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $books = $query->latest()->paginate(5);
        $categories = Category::all();

        return view('admin.books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'publisher' => 'required',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image',
        ]);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('admin.books.index');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'publisher' => 'required',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image',
        ]);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.books.index');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index');
    }
}
