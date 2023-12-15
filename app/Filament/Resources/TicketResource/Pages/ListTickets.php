<?php

namespace App\Filament\Resources\TicketResource\Pages;

use Filament\Actions;
use App\Filament\Widgets\StatsOverview;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TicketResource;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class
        ];
    }
}
