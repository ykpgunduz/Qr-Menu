<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MonthlyStatisticsResource\Pages;
use App\Filament\Resources\MonthlyStatisticsResource\RelationManagers;
use App\Models\PastOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MonthlyStatisticsResource extends Resource
{
    protected static ?string $model = PastOrder::class;

    protected static ?string $pluralModelLabel = "Aylık Veriler";

    protected static ?string $navigationGroup = 'İşletme İstatistikleri';

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMonthlyStatistics::route('/'),
            'create' => Pages\CreateMonthlyStatistics::route('/create'),
            'view' => Pages\ViewMonthlyStatistics::route('/{record}'),
            'edit' => Pages\EditMonthlyStatistics::route('/{record}/edit'),
        ];
    }
}
