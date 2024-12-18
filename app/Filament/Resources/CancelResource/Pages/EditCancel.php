<?php

namespace App\Filament\Resources\CancelResource\Pages;

use App\Filament\Resources\CancelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCancel extends EditRecord
{
    protected static string $resource = CancelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
