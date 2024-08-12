<?php

namespace App\Filament\Resources\AnnualStatisticsResource\Pages;

use App\Filament\Resources\AnnualStatisticsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnnualStatistics extends ListRecords
{
    protected static string $resource = AnnualStatisticsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
