<?php

namespace App\Filament\CustomWidgets;

use Illuminate\Contracts\Support\Htmlable;
use App\Filament\CustomWidgets\MetricWidget;

class MetricWidgetSample extends MetricWidget
{
    protected string|Htmlable $label = "some lable";

    protected $value = 1;
}
