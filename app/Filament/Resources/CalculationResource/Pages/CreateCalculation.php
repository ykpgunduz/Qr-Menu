<?php

namespace App\Filament\Resources\CalculationResource\Pages;

use App\Filament\Resources\CalculationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCalculation extends CreateRecord
{
    protected static string $resource = CalculationResource::class;

    public function getTitle(): string
    {
        return 'Yeni Masa Oluştur';
    }
}
