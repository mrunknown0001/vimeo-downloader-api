<?php

namespace App\Filament\Resources\UsageResource\Widgets;

use Filament\Widgets\ChartWidget;

class HourlyUsage extends ChartWidget
{
    protected static ?string $heading = 'Hourly Usage (24 hours)';

    protected static ?string $pollingInterval = '5m';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'API Requests',
                    'data' => [145, 168, 192, 245, 312, 425, 568, 695, 812, 758, 642, 535, 658, 782, 895, 825, 712, 598, 445, 328, 265, 198, 172, 152],
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => [
                '00:00', '01:00', '02:00', '03:00', '04:00', '05:00',
                '06:00', '07:00', '08:00', '09:00', '10:00', '11:00',
                '12:00', '13:00', '14:00', '15:00', '16:00', '17:00',
                '18:00', '19:00', '20:00', '21:00', '22:00', '23:00',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 100,
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => true,
                    ],
                ],
            ],
            'interaction' => [
                'mode' => 'nearest',
                'axis' => 'x',
                'intersect' => false,
            ],
        ];
    }

    public function getColumnSpan(): int|string|array
    {
        return 'full';
    }
}
