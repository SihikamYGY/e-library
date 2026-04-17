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
            'name' => 'Admin KamiPerpus',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // 👤 USERS (REALISTIC INDONESIAN)
        $users = [
            ['name' => 'Budi Santoso', 'email' => 'budi@gmail.com'],
            ['name' => 'Siti Aminah', 'email' => 'siti@gmail.com'],
            ['name' => 'Andi Pratama', 'email' => 'andi@gmail.com'],
            ['name' => 'Dewi Lestari', 'email' => 'dewi@gmail.com'],
            ['name' => 'Rizky Maulana', 'email' => 'rizky@gmail.com'],
            ['name' => 'Maya Putri', 'email' => 'maya@gmail.com'],
            ['name' => 'Fajar Nugroho', 'email' => 'fajar@gmail.com'],
        ];

        foreach ($users as $u) {
            User::create([
                'name' => $u['name'],
                'email' => $u['email'],
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }

        // 🏷 CATEGORIES (MORE COMPLETE)
        $categories = [
            'Novel',
            'Programming',
            'History',
            'Self Improvement',
            'Science',
            'Fantasy',
            'Business',
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
            ]);
        }

        // 📚 BOOKS (WITH SYNOPSIS)
        $bookData = [
            [
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'isbn' => '9786022912206',
                'publisher' => 'Bentang Pustaka',
                'stock' => 10,
                'category_id' => 1,
                'synopsis' => 'Kisah perjuangan anak-anak di Belitung yang berjuang mendapatkan pendidikan di tengah keterbatasan.',
            ],
            [
                'title' => 'Bumi',
                'author' => 'Tere Liye',
                'isbn' => '9786020332952',
                'publisher' => 'Gramedia',
                'stock' => 8,
                'category_id' => 1,
                'synopsis' => 'Perjalanan dunia paralel yang penuh misteri, petualangan, dan kekuatan yang tidak biasa.',
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'isbn' => '9780735211292',
                'publisher' => 'Penguin Random House',
                'stock' => 12,
                'category_id' => 4,
                'synopsis' => 'Panduan membangun kebiasaan kecil yang berdampak besar untuk meningkatkan kualitas hidup.',
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'isbn' => '9780132350884',
                'publisher' => 'Prentice Hall',
                'stock' => 7,
                'category_id' => 2,
                'synopsis' => 'Panduan menulis kode yang bersih, mudah dibaca, dan mudah dirawat dalam pengembangan software.',
            ],
            [
                'title' => 'Sejarah Dunia',
                'author' => 'Hendrik Willem van Loon',
                'isbn' => '9789799101293',
                'publisher' => 'Narasi',
                'stock' => 5,
                'category_id' => 3,
                'synopsis' => 'Ringkasan sejarah dunia dari awal peradaban hingga era modern dengan gaya naratif.',
            ],
            [
                'title' => 'The Psychology of Money',
                'author' => 'Morgan Housel',
                'isbn' => '9780857197689',
                'publisher' => 'Harriman House',
                'stock' => 9,
                'category_id' => 7,
                'synopsis' => 'Cara berpikir manusia tentang uang, keputusan finansial, dan kebiasaan yang mempengaruhi kekayaan.',
            ],
            [
                'title' => 'Harry Potter and the Philosopher’s Stone',
                'author' => 'J.K. Rowling',
                'isbn' => '9780747532699',
                'publisher' => 'Bloomsbury',
                'stock' => 6,
                'category_id' => 6,
                'synopsis' => 'Seorang anak yatim menemukan dunia sihir dan takdirnya sebagai penyihir besar.',
            ],
        ];

        foreach ($bookData as $data) {
            Book::create($data);
        }

        // 📖 LOANS (REALISTIC FLOW)

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

        // 3️⃣ Pending Return (OVERDUE)
        Loan::create([
            'user_id' => $users[2]->id,
            'book_id' => $books->random()->id,
            'status' => 'pending_return',
            'loan_date' => now()->subDays(10),
            'due_date' => now()->subDays(3),
        ]);

        // 4️⃣ Returned
        Loan::create([
            'user_id' => $users[3]->id,
            'book_id' => $books->random()->id,
            'status' => 'returned',
            'loan_date' => now()->subDays(12),
            'due_date' => now()->subDays(7),
            'return_date' => now()->subDays(4),
        ]);

        // 5️⃣ Rejected
        Loan::create([
            'user_id' => $users[4]->id,
            'book_id' => $books->random()->id,
            'status' => 'rejected',
        ]);
    }
}
