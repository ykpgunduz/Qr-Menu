<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\PastOrder;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Summarizers\Sum;
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
                    ->label('Masa'),
                TextColumn::make('customer')
                    ->label('Kişi Sayısı')
                    ->suffix(' Kişi')
                    ->summarize(Sum::make()),
                TextColumn::make('products')
                    ->label('Sipariş Bilgileri')
                    ->formatStateUsing(fn ($state) => nl2br(implode("\n", explode(',', $state))))
                    ->html(),
                TextColumn::make('total_amount')
                    ->label('Toplam Tutar')
                    ->prefix('Hesap: ')
                    ->suffix('₺')
                    ->summarize(Sum::make()),
                TextColumn::make('payment')
                    ->label('Ödeme'),
                TextColumn::make('created_at')
                    ->label('Masanın Açılış Saati')
                    ->dateTime('H:i | d/m/y'),
                TextColumn::make('updated_at')
                    ->label('Ödenme Saati')
                    ->dateTime('H:i | d/m/y'),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DateTimePicker::make('start')
                            ->label('Başlangıç Tarihi ve Saati')
                            ->default(Carbon::today()),
                        Forms\Components\DateTimePicker::make('end')
                            ->label('Bitiş Tarihi ve Saati')
                            ->default(Carbon::tomorrow()->subSecond()),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->whereBetween('created_at', [
                                Carbon::parse($data['start'] ?? Carbon::today()),
                                Carbon::parse($data['end'] ?? Carbon::tomorrow()->subSecond())
                            ]);
                    })
                    ->default([
                        'start' => Carbon::today(),
                        'end' => Carbon::tomorrow()->subSecond(),
                    ]),
            ])
            ->paginated([
                30,
                60,
                90,
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
