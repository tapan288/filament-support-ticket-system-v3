<?php

namespace App\Filament\Widgets;

use App\Filament\CustomWidgets\AnotherMetricWidget;
use App\Filament\CustomWidgets\MetricWidgetSample;
use App\Filament\CustomWidgets\MetricsOverviewWidget;

class MetricsOverviewSample extends MetricsOverviewWidget
{
    protected function getMetrics(): array
    {
        return [
            MetricWidgetSample::class,
            AnotherMetricWidget::class,
        ];
    }
}
