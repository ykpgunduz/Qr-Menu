<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\OrderItem;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;

class OrderResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?string $navigationGroup = 'Siparişler ve Masalar';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $pluralModelLabel = "Siparişler";

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
                TextColumn::make('quantity')
                    ->label('Miktar')->formatStateUsing(fn ($state) => $state . ' adet'),
                TextColumn::make('product.title')
                    ->label('Ürün Adı'),
                TextColumn::make('calculation.table_number')
                    ->suffix('. Masa')
                    ->label('Masa Numarası'),
                BadgeColumn::make('status')
                    ->label('Sipariş Durumu')
                    ->colors([
                        'info' => 'Yeni Sipariş',
                        'warning' => 'Hazırlanıyor',
                        'success' => 'Teslim Edildi',
                        'danger' => 'İptal Edildi',
                    ])
                    ->icons([
                        'heroicon-o-sparkles' => 'Yeni Sipariş',
                        'heroicon-o-clock' => 'Hazırlanıyor',
                        'heroicon-o-check-circle' => 'Teslim Edildi',
                        'heroicon-o-x-circle' => 'İptal Edildi',
                    ])
                    ->action(function($record, $column) {
                        $currentStatus = $record->status;
                        $nextStatus = self::getNextStatus($currentStatus); // Call static method

                        $record->update([
                            'status' => $nextStatus,
                        ]);
                    }),
                TextColumn::make('created_at')
                    ->label('Saat ve Tarih')
                    ->dateTime('H:i | d/m'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    protected static function getNextStatus($currentStatus)
    {
        $statuses = [
            'Yeni Sipariş' => 'Hazırlanıyor',
            'Hazırlanıyor' => 'Teslim Edildi',
            'Teslim Edildi' => 'İptal Edildi',
            'İptal Edildi' => 'Yeni Sipariş',
        ];

        return $statuses[$currentStatus] ?? 'Yeni Sipariş';
    }
}
