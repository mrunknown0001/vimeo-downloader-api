<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;

class UserStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::where('role', 'user')
                    ->count())
                ->description('All registered users')
                ->color('success'),

            Stat::make('Active Users', User::where('is_active', true)
                    ->where('role', 'user')
                    ->count())
                ->description('Currently active')
                ->color('info'),
        ];
    }

    protected function getColumns(): int 
    {
        return 2;
    }
}
