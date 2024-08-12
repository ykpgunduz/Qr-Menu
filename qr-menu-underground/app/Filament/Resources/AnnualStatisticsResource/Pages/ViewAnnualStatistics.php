<?php

namespace App\Filament\Resources\AnnualStatisticsResource\Pages;

use App\Filament\Resources\AnnualStatisticsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAnnualStatistics extends ViewRecord
{
    protected static string $resource = AnnualStatisticsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
