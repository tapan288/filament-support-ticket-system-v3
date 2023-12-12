<?php

namespace App\Filament\Widgets;

use App\Models\Role;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestTickets extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                auth()->user()->hasRole(Role::ROLES['Admin']) ? Ticket::query() : Ticket::where('assigned_to', auth()->id())
            )
            ->columns([
                TextColumn::make('title')
                    ->description(fn(Ticket $record): ?string => $record?->description ?? null)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => Ticket::STATUS['Archived'],
                        'success' => Ticket::STATUS['Closed'],
                        'danger' => Ticket::STATUS['Open'],
                    ]),
                TextColumn::make('priority')
                    ->badge()
                    ->colors([
                        'warning' => Ticket::PRIORITY['Medium'],
                        'success' => Ticket::PRIORITY['Low'],
                        'danger' => Ticket::PRIORITY['High'],
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
            ]);
    }
}
