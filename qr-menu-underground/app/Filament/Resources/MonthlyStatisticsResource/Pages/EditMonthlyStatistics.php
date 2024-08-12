<?php

namespace App\Filament\Resources\MonthlyStatisticsResource\Pages;

use App\Filament\Resources\MonthlyStatisticsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMonthlyStatistics extends EditRecord
{
    protected static string $resource = MonthlyStatisticsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
