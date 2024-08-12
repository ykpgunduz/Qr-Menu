<?php

namespace App\Filament\Resources\WeeklyStatisticsResource\Pages;

use App\Filament\Resources\WeeklyStatisticsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWeeklyStatistics extends ViewRecord
{
    protected static string $resource = WeeklyStatisticsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
