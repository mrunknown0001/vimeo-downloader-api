<?php

namespace App\Filament\Resources\UsageResource\Pages;

use App\Filament\Resources\UsageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\UsageResource\Widgets\HourlyUsage;

class ListUsages extends ListRecords
{
    protected static string $resource = UsageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            HourlyUsage::class,
        ];
    }
}
