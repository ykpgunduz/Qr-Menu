<?php

namespace App\Filament\Resources\PastOrderResource\Pages;

use App\Filament\Resources\PastOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPastOrder extends ViewRecord
{
    protected static string $resource = PastOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
