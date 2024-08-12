<?php

namespace App\Filament\Resources\MonthlyStatisticsResource\Pages;

use App\Filament\Resources\MonthlyStatisticsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMonthlyStatistics extends ListRecords
{
    protected static string $resource = MonthlyStatisticsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
