<?php

namespace App\Filament\CustomWidgets;

use Illuminate\Contracts\Support\Htmlable;
use App\Filament\CustomWidgets\MetricWidget;

class AnotherMetricWidget extends MetricWidget
{
    protected string|Htmlable $label = "another lable";

    protected $value = 3;
}
