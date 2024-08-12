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
use App\Filament\Resources\WeeklyStatisticsResource\Pages;
use App\Filament\Resources\WeeklyStatisticsResource\RelationManagers;

class WeeklyStatisticsResource extends Resource
{
    protected static ?string $model = PastOrder::class;

    protected static ?string $pluralModelLabel = "Haftalık Veriler";

    protected static ?string $navigationGroup = 'İşletme İstatistikleri';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

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
            'index' => Pages\ListWeeklyStatistics::route('/'),
            'create' => Pages\CreateWeeklyStatistics::route('/create'),
            'view' => Pages\ViewWeeklyStatistics::route('/{record}'),
            'edit' => Pages\EditWeeklyStatistics::route('/{record}/edit'),
        ];
    }
}
