<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\PastOrder;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PastOrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PastOrderResource\RelationManagers;

class PastOrderResource extends Resource
{
    protected static ?string $model = PastOrder::class;

    protected static ?string $navigationGroup = 'Masalar ve Siparişler';

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $pluralModelLabel = "Ödenen Siparişler";

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
                TextColumn::make('table_number')
                    ->suffix('. Masa')
                    ->label('Masa Numarası'),
                TextColumn::make('session_id')
                    ->label('Müşteri Numarası')
                    ->formatStateUsing(function ($state) {
                        // İlk 5 karakteri al
                        return substr($state, 0, 11);
                    }),
                TextColumn::make('quantity')
                    ->label('Miktar')->formatStateUsing(fn ($state) => $state . ' adet'),
                TextColumn::make('product_name')
                    ->label('Ürün Adı'),
                TextColumn::make('price')
                    ->label('Ürün Fiyatı')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                    ->suffix('₺'),
                TextColumn::make('created_at')
                    ->label('Masanın Açılış Saati')
                    ->dateTime('H:i | d/m/y'),
                TextColumn::make('updated_at')
                    ->label('Ödenme Saati')
                    ->dateTime('H:i | d/m/y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListPastOrders::route('/'),
            'create' => Pages\CreatePastOrder::route('/create'),
            'view' => Pages\ViewPastOrder::route('/{record}'),
            'edit' => Pages\EditPastOrder::route('/{record}/edit'),
        ];
    }
}
