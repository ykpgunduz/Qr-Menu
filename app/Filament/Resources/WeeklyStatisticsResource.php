<?php

namespace App\Filament\Resources;

use App\Models\PastOrder;
use Filament\Resources\Resource;
use App\Filament\Resources\WeeklyStatisticsResource\Pages\ListWeeklyStatistics;

class WeeklyStatisticsResource extends Resource
{
    protected static ?string $model = PastOrder::class;

    protected static ?string $pluralModelLabel = "Haftalık Veriler";

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'İşletme İstatistikleri';

    public static function getPages(): array
    {
        return [
            'index' => ListWeeklyStatistics::route('/'),
        ];
    }
}
