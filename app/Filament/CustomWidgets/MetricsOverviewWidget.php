<?php

namespace App\Filament\CustomWidgets;

use Filament\Widgets\Widget;
use Filament\Widgets\Concerns\CanPoll;

class MetricsOverviewWidget extends Widget
{
    use CanPoll;

    protected static string $view = 'filament.custom-widgets.metrics-overview-widget';

    /**
     * @var array<MetricWidget> | null
     */
    protected ?array $cachedMetrics = null;

    protected int|string|array $columnSpan = 'full';

    protected function getColumns(): int
    {
        $count = count($this->getCachedMetrics());

        if ($count < 3) {
            return 3;
        }

        if (($count % 3) !== 1) {
            return 3;
        }

        return 4;
    }

    /**
     * @return array<MetricWidget>
     */
    protected function getCachedMetrics(): array
    {
        return $this->cachedMetrics ??= $this->getMetrics();
    }

    /**
     * @return array<MetricWidget>
     */
    protected function getMetrics(): array
    {
        return [];
    }
}
