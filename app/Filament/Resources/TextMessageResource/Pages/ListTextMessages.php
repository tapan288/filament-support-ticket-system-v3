<?php

namespace App\Filament\Resources\TextMessageResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TextMessageResource;

class ListTextMessages extends ListRecords
{
    protected static string $resource = TextMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
