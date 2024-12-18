<?php

namespace App\Filament\Resources\PastOrderResource\Pages;

use App\Filament\Resources\PastOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPastOrder extends EditRecord
{
    protected static string $resource = PastOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
