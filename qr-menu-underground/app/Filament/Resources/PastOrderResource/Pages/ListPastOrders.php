<?php

namespace App\Filament\Resources\PastOrderResource\Pages;

use App\Filament\Resources\PastOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPastOrders extends ListRecords
{
    protected static string $resource = PastOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
