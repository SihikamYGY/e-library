<?php

namespace Database\Seeders;

use App\Models\Book;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // ADMIN
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // USERS
        $users = User::factory(5)->create();

        // CATEGORIES
        $categories = Category::insert([
            ['name' => 'Novel'],
            ['name' => 'Programming'],
            ['name' => 'History'],
        ]);

        // BOOKS
        $bookData = [
            ['title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'stock' => 10, 'category_id' => 1],
            ['title' => 'Bumi', 'author' => 'Tere Liye', 'stock' => 8, 'category_id' => 1],
            ['title' => 'Atomic Habits', 'author' => 'James Clear', 'stock' => 12, 'category_id' => 3],
            ['title' => 'Clean Code', 'author' => 'Robert C. Martin', 'stock' => 7, 'category_id' => 2],
            ['title' => 'Sejarah Dunia', 'author' => 'Hendrik Willem van Loon', 'stock' => 5, 'category_id' => 3],
        ];

        foreach ($bookData as $data) {
            Book::create($data);
        }

        // LOANS
        foreach ($users as $user) {
            Loan::create([
                'user_id' => $user->id,
                'book_id' => rand(1, 5),
                'loan_date' => now(),
                'status' => 'borrowed',
            ]);
        }
    }
}
