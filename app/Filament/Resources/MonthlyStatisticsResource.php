<?php

namespace App\Filament\Resources;

use App\Models\PastOrder;
use Filament\Resources\Resource;
use App\Filament\Resources\MonthlyStatisticsResource\Pages\ListMonthlyStatistics;

class MonthlyStatisticsResource extends Resource
{
    protected static ?string $model = PastOrder::class;

    protected static ?string $pluralModelLabel = "Aylık Veriler";

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    protected static ?string $navigationGroup = 'İşletme İstatistikleri';

    public static function getPages(): array
    {
        return [
            'index' => ListMonthlyStatistics::route('/'),
        ];
    }
}
