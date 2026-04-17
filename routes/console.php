<?php

use App\Models\Loan;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment('Stay motivated!');
});

// 🔥 AUTO BLACKLIST
Schedule::call(function () {
    $users = User::all();

    foreach ($users as $user) {
        $hasLateLoan = Loan::where('user_id', $user->id)
            ->where('status', 'approved')
            ->where('due_date', '<', now())
            ->exists();

        $user->update([
            'is_blacklisted' => $hasLateLoan,
        ]);
    }
})->everyMinute();

// 🔥 AUTO FINE
Schedule::call(function () {

    $loans = Loan::where('status', 'approved')
        ->whereNotNull('due_date')
        ->get();

    foreach ($loans as $loan) {
        $loan->update([
            'fine' => $loan->calculateFine(),
        ]);
    }

})->everyMinute();
