<?php

namespace App\Filament\Resources\WeeklyStatisticsResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\WeeklyStatisticsResource;
use App\Filament\Resources\WeeklyStatisticsResource\Widgets\WeeklyChart;
use App\Filament\Resources\WeeklyStatisticsResource\Widgets\WeeklyDrinkWidget;
use App\Filament\Resources\WeeklyStatisticsResource\Widgets\WeeklyStatsOverview;

class ListWeeklyStatistics extends ListRecords
{
    protected static string $resource = WeeklyStatisticsResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            WeeklyStatsOverview::class,
            WeeklyChart::class,
            WeeklyDrinkWidget::class
        ];
    }
}
