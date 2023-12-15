<?php

namespace App\Filament\Resources\TextMessageResource\Pages;

use App\Filament\Resources\TextMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTextMessage extends EditRecord
{
    protected static string $resource = TextMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
