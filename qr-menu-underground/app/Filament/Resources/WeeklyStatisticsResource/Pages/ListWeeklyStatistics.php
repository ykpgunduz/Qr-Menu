<?php

namespace App\Filament\Resources\WeeklyStatisticsResource\Pages;

use App\Filament\Resources\WeeklyStatisticsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeeklyStatistics extends ListRecords
{
    protected static string $resource = WeeklyStatisticsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
