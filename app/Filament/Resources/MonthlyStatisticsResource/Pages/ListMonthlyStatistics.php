<?php

namespace App\Filament\Resources\MonthlyStatisticsResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\MonthlyStatisticsResource;
use App\Filament\Resources\MonthlyStatisticsResource\Widgets\MonthlyChart;
use App\Filament\Resources\MonthlyStatisticsResource\Widgets\MonthlyDrinkWidget;
use App\Filament\Resources\MonthlyStatisticsResource\Widgets\MonthlyStatsOverview;

class ListMonthlyStatistics extends ListRecords
{
    protected static string $resource = MonthlyStatisticsResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            MonthlyStatsOverview::class,
            MonthlyChart::class,
            MonthlyDrinkWidget::class,
        ];
    }
}
