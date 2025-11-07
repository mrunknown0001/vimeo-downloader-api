<?php

namespace App\Filament\Resources\UsageResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Usage;
use Illuminate\Support\Facades\DB;

class HourlyUsage extends ChartWidget
{
    protected static ?string $heading = 'Usage Per Hour (Last 24 Hours)';

    protected static ?int $sort = 2;

    protected static ?string $maxHeight = '300px';

    // Update every 5 minutes
    protected static ?string $pollingInterval = '5m';

    protected function getData(): array
    {
        $now = now();
        $past24Hours = $now->copy()->subHours(24);

        // Get hourly usage data from the database
        $usageData = Usage::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d %H:00:00") as hour'),
                DB::raw('SUM(point) as total_points')
            )
            ->where('created_at', '>=', $past24Hours)
            ->groupBy('hour')
            ->orderBy('hour')
            ->get()
            ->keyBy('hour');

        // Generate all hours for the past 24 hours
        $hours = collect();
        for ($i = 23; $i >= 0; $i--) {
            $hour = $now->copy()->subHours($i)->startOfHour();
            $hourKey = $hour->format('Y-m-d H:00:00');
            
            $hours->push([
                'label' => $hour->format('H:i'),
                'full_label' => $hour->format('M d, H:i'),
                'points' => $usageData->get($hourKey)->total_points ?? 0,
            ]);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Points',
                    'data' => $hours->pluck('points')->toArray(),
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $hours->pluck('label')->toArray(),
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
                        'precision' => 0,
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


