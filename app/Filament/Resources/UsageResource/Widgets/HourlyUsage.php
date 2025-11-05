<?php

namespace App\Filament\Resources\UsageResource\Widgets;

use Filament\Widgets\ChartWidget;

class HourlyUsage extends ChartWidget
{
    protected static ?string $heading = 'Hourly Usage (24 hours)';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

public function getColumnSpan(): int|string|array
{
    return 'full';
}
}
