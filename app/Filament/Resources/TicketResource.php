<?php

namespace App\Filament\Resources;

use App\Models\Role;
use App\Models\User;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextInputColumn;
use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers\CategoriesRelationManager;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                TextInput::make('title')
                    ->autofocus()
                    ->required(),
                Textarea::make('description')
                    ->rows(3),
                Select::make('status')
                    ->options(self::$model::STATUS)
                    ->required()
                    ->in(self::$model::STATUS),
                Select::make('priority')
                    ->options(self::$model::PRIORITY)
                    ->required()
                    ->in(self::$model::PRIORITY),
                Select::make('assigned_to')
                    ->options(
                        User::whereHas('roles', function (Builder $query) {
                            $query->where('name', Role::ROLES['Agent']);
                        })->pluck('name', 'id')->toArray(),
                    )
                    ->required(),
                Textarea::make('comment')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) =>
                auth()->user()->hasRole(Role::ROLES['Admin']) ?
                $query : $query->where('assigned_to', auth()->id())
            )
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('title')
                    ->description(fn(Ticket $record): ?string => $record?->description ?? null)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => self::$model::STATUS['Archived'],
                        'success' => self::$model::STATUS['Closed'],
                        'danger' => self::$model::STATUS['Open'],
                    ]),
                TextColumn::make('priority')
                    ->badge()
                    ->colors([
                        'warning' => self::$model::PRIORITY['Medium'],
                        'success' => self::$model::PRIORITY['Low'],
                        'danger' => self::$model::PRIORITY['High'],
                    ]),
                TextColumn::make('assignedTo.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('assignedBy.name')
                    ->searchable()
                    ->sortable(),
                TextInputColumn::make('comment'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(self::$model::STATUS)
                    ->placeholder('Filter By Status'),
                SelectFilter::make('priority')
                    ->options(self::$model::PRIORITY)
                    ->placeholder('Filter By Priority'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
