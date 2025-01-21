<?php

namespace App\Filament\Resources\CafeResource\Pages;

use App\Filament\Resources\CafeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCafe extends EditRecord
{
    protected static string $resource = CafeResource::class;

    public function getTitle(): string
    {
        return 'Kafe Bilgilerini Düzenle';
    }
}
