<?php

namespace App\Filament\Resources\CancelResource\Pages;

use App\Filament\Resources\CancelResource;
use Filament\Resources\Pages\ListRecords;

class ListCancels extends ListRecords
{
    protected static string $resource = CancelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
