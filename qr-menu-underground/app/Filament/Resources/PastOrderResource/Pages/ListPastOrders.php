<?php

namespace App\Filament\Resources\PastOrderResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PastOrderResource;
use App\Filament\Resources\PastOrderResource\Widgets\PastOrderWidget;

class ListPastOrders extends ListRecords
{
    protected static string $resource = PastOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PastOrderWidget::class
        ];
    }
}

