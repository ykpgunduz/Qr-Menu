<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\PastOrder;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ComparisonResource\Pages;
use App\Filament\Resources\ComparisonResource\RelationManagers;

class ComparisonResource extends Resource
{
    protected static ?string $model = PastOrder::class;

    protected static ?string $pluralModelLabel = "Karşılaştırma";

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComparisons::route('/'),
        ];
    }
}
