<?php

namespace App\Filament\Resources\TicketResource\Widgets;

use App\Models\Ticket;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\CustomWidgets\MetricWidget;

class MetricWidgetSample extends MetricWidget
{
    protected string|Htmlable $label = "Tickets Overview";

    public ?string $filter = 'week';

    public function getValue()
    {
        return match ($this->filter) {
            'week' => Ticket::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'month' => Ticket::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count(),
            'year' => Ticket::whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()])->count(),
        };
    }

    protected function getFilters(): ?array
    {
        return [
            'week' => 'This Week',
            'month' => 'This Month',
            'year' => 'This Year',
        ];
    }
}
