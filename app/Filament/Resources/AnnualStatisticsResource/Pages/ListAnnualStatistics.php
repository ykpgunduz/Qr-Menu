<?php

namespace App\Filament\Resources\AnnualStatisticsResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\AnnualStatisticsResource;
use App\Filament\Resources\AnnualStatisticsResource\Widgets\AnnualChart;
use App\Filament\Resources\AnnualStatisticsResource\Widgets\AnnualDrinkWidget;
use App\Filament\Resources\AnnualStatisticsResource\Widgets\AnnualStatsOverview;

class ListAnnualStatistics extends ListRecords
{
    protected static string $resource = AnnualStatisticsResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            AnnualStatsOverview::class,
            AnnualChart::class,
            AnnualDrinkWidget::class,
        ];
    }
}
