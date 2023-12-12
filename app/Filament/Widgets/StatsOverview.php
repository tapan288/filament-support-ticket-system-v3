<?php

namespace App\Filament\Widgets;

use App\Models\Role;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Tickets', Ticket::count()),
            Stat::make('Total Categories', Category::where('is_active', true)->count()),
            Stat::make('Total Agents', User::whereHas('roles', function (Builder $query) {
                $query->where('name', Role::ROLES['Agent']);
            })->count()),
        ];
    }
}
