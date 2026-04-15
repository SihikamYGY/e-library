<?php

use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLoanController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect('/books');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| PROFILE (AUTH)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| USER AREA
|--------------------------------------------------------------------------
*/

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

Route::middleware('auth')->group(function () {

    // 📥 Request loan
    Route::post('/loans/{book}', [LoanController::class, 'store'])
        ->name('loans.store');

    // 🔁 Request return
    Route::post('/loans/{loan}/return', [LoanController::class, 'returnRequest'])
        ->name('loans.return');

    // 📋 My loans
    Route::get('/my-loans', [LoanController::class, 'myLoans'])
        ->name('loans.my');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // 📊 Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])
            ->name('dashboard');

        // 📚 Books & Categories
        Route::resource('books', AdminBookController::class);
        Route::resource('categories', CategoryController::class);

        // 🔥 LOANS SYSTEM (FIXED)
        Route::get('/loans', [AdminLoanController::class, 'index'])
            ->name('loans.index');

        Route::post('/loans/{loan}/approve', [AdminLoanController::class, 'approve'])
            ->name('loans.approve');

        Route::post('/loans/{loan}/reject', [AdminLoanController::class, 'reject'])
            ->name('loans.reject');

        Route::post('/loans/{loan}/approve-return', [AdminLoanController::class, 'approveReturn'])
            ->name('loans.approveReturn');
    });

require __DIR__.'/auth.php';