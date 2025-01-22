<?php

namespace App\Filament\Resources\RatingResource\Pages;

use App\Filament\Resources\RatingResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\RatingResource\Widgets\StatsOverview;

class ListRatings extends ListRecords
{
    protected static string $resource = RatingResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class
        ];
    }
}
