<?php

use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLoanController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect('/admin/dashboard');
    }

    return redirect('/'); // nanti ke homepage user
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// USER
// Route::get('/', [HomeController::class, 'index']);
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::post('/loans', [LoanController::class, 'store']);
    Route::get('/my-loans', [LoanController::class, 'myLoans']);
});

// ADMIN
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])
            ->name('dashboard');

        Route::resource('books', AdminBookController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('loans', AdminLoanController::class);
    });

require __DIR__.'/auth.php';
