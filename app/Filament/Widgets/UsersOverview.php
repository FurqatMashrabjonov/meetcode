<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class UsersOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $query = User::query();
        $users_count = $query->count();
        $users_count_today = $query->whereDate('created_at', today())->count();
        return [
            Stat::make('The number of Users', Number::forHumans($users_count))
                ->description($users_count_today . ' registered today')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),

            //TODO: Add another stat here
        ];
    }
}
