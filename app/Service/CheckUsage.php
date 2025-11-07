<?php

namespace App\Service;

use App\Models\Usage;

class CheckUsage
{
    public function check($user)
    {
        // Check if user has no usage yet
        $count = $user->usage()->count();
        if($count < 1) {
            return 0;
        }
        // Get the user's current month's usage points
        $points = $user->usage()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('point');

        return $points;
    }
}
