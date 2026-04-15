<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 🔑 ADMIN
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // 👤 USERS (NAMA INDONESIA)
        $users = [
            ['name' => 'Budi Santoso', 'email' => 'budi@gmail.com'],
            ['name' => 'Siti Aminah', 'email' => 'siti@gmail.com'],
            ['name' => 'Andi Pratama', 'email' => 'andi@gmail.com'],
            ['name' => 'Dewi Lestari', 'email' => 'dewi@gmail.com'],
            ['name' => 'Rizky Maulana', 'email' => 'rizky@gmail.com'],
        ];

        foreach ($users as $u) {
            User::create([
                'name' => $u['name'],
                'email' => $u['email'],
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }

        // 📚 CATEGORIES
        Category::insert([
            ['name' => 'Novel'],
            ['name' => 'Programming'],
            ['name' => 'History'],
        ]);

        // 📖 BOOKS (udah include isbn & publisher)
        $bookData = [
            [
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'isbn' => '9786022912206',
                'publisher' => 'Bentang Pustaka',
                'stock' => 10,
                'category_id' => 1,
            ],
            [
                'title' => 'Bumi',
                'author' => 'Tere Liye',
                'isbn' => '9786020332952',
                'publisher' => 'Gramedia',
                'stock' => 8,
                'category_id' => 1,
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'isbn' => '9780735211292',
                'publisher' => 'Penguin Random House',
                'stock' => 12,
                'category_id' => 3,
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'isbn' => '9780132350884',
                'publisher' => 'Prentice Hall',
                'stock' => 7,
                'category_id' => 2,
            ],
            [
                'title' => 'Sejarah Dunia',
                'author' => 'Hendrik Willem van Loon',
                'isbn' => '9789799101293',
                'publisher' => 'Narasi',
                'stock' => 5,
                'category_id' => 3,
            ],
        ];

        foreach ($bookData as $data) {
            Book::create($data);
        }

        // 🔁 LOANS (REALISTIC FLOW)
        $books = Book::all();
        $users = User::where('role', 'user')->get();

        // 1️⃣ Pending
        Loan::create([
            'user_id' => $users[0]->id,
            'book_id' => $books->random()->id,
            'status' => 'pending',
        ]);

        // 2️⃣ Approved
        Loan::create([
            'user_id' => $users[1]->id,
            'book_id' => $books->random()->id,
            'status' => 'approved',
            'loan_date' => now()->subDays(2),
            'due_date' => now()->addDays(5),
        ]);

        // 3️⃣ Pending Return
        Loan::create([
            'user_id' => $users[2]->id,
            'book_id' => $books->random()->id,
            'status' => 'pending_return',
            'loan_date' => now()->subDays(8),
            'due_date' => now()->subDays(2),
        ]);

        // 4️⃣ Returned
        Loan::create([
            'user_id' => $users[3]->id,
            'book_id' => $books->random()->id,
            'status' => 'returned',
            'loan_date' => now()->subDays(10),
            'due_date' => now()->subDays(5),
            'return_date' => now()->subDays(3),
        ]);

        // 5️⃣ Rejected
        Loan::create([
            'user_id' => $users[4]->id,
            'book_id' => $books->random()->id,
            'status' => 'rejected',
        ]);
    }
}
