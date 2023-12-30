<?php

namespace App\Filament\Widgets;

use Illuminate\Contracts\Support\Htmlable;
use App\Filament\CustomWidgets\MetricWidget;

class MetricWidgetFromCommand extends MetricWidget
{
    protected string|Htmlable $label = "Example Label";

    public function getValue()
    {
        return "123";
    }
}
