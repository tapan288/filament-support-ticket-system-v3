<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TextMessage;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\TextMessageResource\Pages;

class TextMessageResource extends Resource
{
    protected static ?string $model = TextMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),
                TextColumn::make('sentBy.name')
                    ->searchable()
                    ->sortable()
                    ->default('-')
                    ->label('Message Sent By'),
                TextColumn::make('sentTo.name')
                    ->searchable()
                    ->sortable()
                    ->default('-'),
                TextColumn::make('message')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('remarks')
                    ->default('-')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->sortable()
                    ->date(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(TextMessage::STATUS),
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTextMessages::route('/'),
        ];
    }
}
