<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Enums\UserRole;

class SupplyFreePlan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:user-free';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Supply Free Plan for all users (Role: user) with no existing subscription plan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all Role (user) that is Active and don't have a plan
        $users = User::whereDoesntHave('userPlan')
                    ->where('is_active', true)
                    ->where('role', UserRole::User)
                    ->get();

        // Check if number of users is > 0
        if($users->count() < 1) {
            $this->info('No User found to add on free tier.');
            return Command::SUCCESS;
        }

        // Supply with Free Tier Account
        foreach($users as $user) {
            $user->userPlan()->create([
                'user_id' => $user->id,
                'plan_id' => 1,
            ]);
        }

        $this->info("Successfully added {$users->count()} user(s) to free tier.");
        return Command::SUCCESS;
    }
}