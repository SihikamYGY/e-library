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
}
