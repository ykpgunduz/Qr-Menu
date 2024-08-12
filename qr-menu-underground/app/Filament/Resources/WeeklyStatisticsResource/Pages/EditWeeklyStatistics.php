<?php

namespace App\Filament\Resources\WeeklyStatisticsResource\Pages;

use App\Filament\Resources\WeeklyStatisticsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeeklyStatistics extends EditRecord
{
    protected static string $resource = WeeklyStatisticsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
