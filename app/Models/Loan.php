<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'loan_date',
        'due_date',
        'return_date',
        'fine',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function getFineAttribute($value)
    {
        if ($this->status === 'approved' && now()->gt($this->due_date)) {
            $daysLate = now()->diffInDays($this->due_date);

            return $daysLate * 1000;
        }

        return $value;
    }

    public function isOverdue()
    {
        return $this->status === 'approved' && $this->due_date < now();
    }

    public function calculateFine()
    {
        if (! $this->due_date || $this->status !== 'approved') {
            return 0;
        }

        if (now()->lte($this->due_date)) {
            return 0;
        }

        $daysLate = now()->diffInDays($this->due_date);

        // 💰 Progressive fine
        if ($daysLate <= 3) {
            return $daysLate * 1000;
        }

        if ($daysLate <= 7) {
            return (3 * 1000) + (($daysLate - 3) * 2000);
        }

        return (3 * 1000) + (4 * 2000) + (($daysLate - 7) * 5000);
    }
}
