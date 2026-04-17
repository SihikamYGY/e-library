<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Loan;

class CheckBlacklist extends Command
{
    protected $signature = 'app:check-blacklist';
    protected $description = 'Auto check overdue loans and blacklist users';

    public function handle()
    {
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

        $this->info('Blacklist updated successfully!');
    }
}