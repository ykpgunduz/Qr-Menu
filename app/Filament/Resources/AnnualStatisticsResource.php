<?php

namespace App\Filament\Resources;

use App\Models\PastOrder;
use Filament\Resources\Resource;
use App\Filament\Resources\AnnualStatisticsResource\Pages\ListAnnualStatistics;

class AnnualStatisticsResource extends Resource
{
    protected static ?string $model = PastOrder::class;

    protected static ?string $pluralModelLabel = "Yıllık Veriler";

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationGroup = 'İşletme İstatistikleri';

    public static function getPages(): array
    {
        return [
            'index' => ListAnnualStatistics::route('/'),
        ];
    }
}
