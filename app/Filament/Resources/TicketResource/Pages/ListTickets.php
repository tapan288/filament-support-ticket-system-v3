<?php

namespace App\Filament\Resources\TicketResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TicketResource;
use App\Filament\Resources\TicketResource\Widgets\MetricsOverviewSample;

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
            MetricsOverviewSample::class
        ];
    }
}
