<?php

namespace App\Filament\CustomWidgets;

use Closure;
use Illuminate\Support\Str;
use Filament\Widgets\Widget;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\IconPosition;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\ComponentAttributeBag;

class MetricWidget extends Widget
{
    protected static string $view = 'filament.custom-widgets.metric-widget';

    // /**
    //  * @var array<string, mixed> | null
    //  */
    // protected ?array $chart = null;

    // /**
    //  * @var string | array{50: string, 100: string, 200: string, 300: string, 400: string, 500: string, 600: string, 700: string, 800: string, 900: string, 950: string} | null
    //  */
    // protected string | array | null $chartColor = null;

    /**
     * @var string | array{50: string, 100: string, 200: string, 300: string, 400: string, 500: string, 600: string, 700: string, 800: string, 900: string, 950: string} | null
     */
    protected string|array|null $color = null;

    protected ?string $icon = null;

    protected string|Htmlable|null $description = null;

    protected ?string $descriptionIcon = null;

    protected IconPosition|string|null $descriptionIconPosition = null;

    /**
     * @var string | array{50: string, 100: string, 200: string, 300: string, 400: string, 500: string, 600: string, 700: string, 800: string, 900: string, 950: string} | null
     */
    protected string|array|null $descriptionColor = null;

    /**
     * @var array<string, scalar>
     */
    protected array $extraAttributes = [];

    protected ?string $id = null;

    protected string|Htmlable $label;

    /**
     * @var scalar | Htmlable | Closure
     */
    protected $value;

    /**
     * @return array<string, mixed> | null
     */
    public function getChart(): ?array
    {
        return $this->chart;
    }

    /**
     * @return string | array{50: string, 100: string, 200: string, 300: string, 400: string, 500: string, 600: string, 700: string, 800: string, 900: string, 950: string} | null
     */
    public function getChartColor(): string|array|null
    {
        return $this->chartColor ?? $this->color;
    }

    /**
     * @return string | array{50: string, 100: string, 200: string, 300: string, 400: string, 500: string, 600: string, 700: string, 800: string, 900: string, 950: string} | null
     */
    public function getColor(): string|array|null
    {
        return $this->color;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function getDescription(): string|Htmlable|null
    {
        return $this->description;
    }

    /**
     * @return string | array{50: string, 100: string, 200: string, 300: string, 400: string, 500: string, 600: string, 700: string, 800: string, 900: string, 950: string} | null
     */
    public function getDescriptionColor(): string|array|null
    {
        return $this->descriptionColor ?? $this->color;
    }

    public function getDescriptionIcon(): ?string
    {
        return $this->descriptionIcon;
    }

    public function getDescriptionIconPosition(): IconPosition|string
    {
        return $this->descriptionIconPosition ?? IconPosition::After;
    }

    /**
     * @return array<string, scalar>
     */
    public function getExtraAttributes(): array
    {
        return $this->extraAttributes;
    }

    public function getExtraAttributeBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getExtraAttributes());
    }

    public function getLabel(): string|Htmlable
    {
        return $this->label;
    }

    public function getId(): string
    {
        return $this->id ?? Str::slug($this->getLabel());
    }

    /**
     * @return scalar | Htmlable | Closure
     */
    public function getValue()
    {
        return value($this->value);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function generateDataChecksum(): string
    {
        return md5(json_encode($this->getChart()) . now());
    }
}
