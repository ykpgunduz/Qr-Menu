<?php

namespace App\Filament\Resources\AnnualStatisticsResource\Pages;

use App\Filament\Resources\AnnualStatisticsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnnualStatistics extends EditRecord
{
    protected static string $resource = AnnualStatisticsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
