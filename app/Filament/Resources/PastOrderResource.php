<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\PastOrder;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use App\Filament\Resources\PastOrderResource\Pages;
use Filament\Tables\Actions\Action;

class PastOrderResource extends Resource
{
    protected static ?string $model = PastOrder::class;

    protected static ?string $navigationGroup = 'Masalar ve Sipariş Yönetimi';

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $pluralModelLabel = "Ödenen Siparişler";

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
                TextColumn::make('credit_card')
                    ->label('POS')
                    ->suffix('₺')
                    ->summarize(Sum::make()),
                TextColumn::make('cash_money')
                    ->label('Nakit')
                    ->suffix('₺')
                    ->summarize(Sum::make()),
                TextColumn::make('iban')
                    ->label('IBAN')
                    ->suffix('₺')
                    ->summarize(Sum::make()),
                TextColumn::make('total_amount')
                    ->label('Brüt')
                    ->suffix('₺')
                    ->summarize(Sum::make()),
                TextColumn::make('net_amount')
                    ->label('Net Satış')
                    ->suffix('₺')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->summarize(Sum::make()),
                TextColumn::make('ikram')
                    ->label('İkram')
                    ->prefix('-')
                    ->suffix('₺')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->summarize(Sum::make()),
                TextColumn::make('selfikram')
                    ->label('Self İkram')
                    ->prefix('-')
                    ->suffix('₺')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->summarize(Sum::make()),
                TextColumn::make('created_at')
                    ->label('Masa Açılış Saati')
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
                            ->default(
                                now()->hour < 3
                                    ? Carbon::yesterday()->hour(8)
                                    : Carbon::today()->hour(8)
                            ),
                        Forms\Components\DateTimePicker::make('end')
                            ->label('Bitiş Tarihi ve Saati')
                            ->default(
                                now()->hour < 3
                                    ? Carbon::today()->hour(3)
                                    : Carbon::tomorrow()->hour(3)
                            ),
                    ])
                    ->query(function (Builder $query, array $data) {
                        $start = Carbon::parse($data['start'] ?? (
                            now()->hour < 3
                                ? Carbon::yesterday()->hour(8)
                                : Carbon::today()->hour(8)
                        ));
                        $end = Carbon::parse($data['end'] ?? (
                            now()->hour < 3
                                ? Carbon::today()->hour(3)
                                : Carbon::tomorrow()->hour(3)
                        ));

                        return $query->whereBetween('created_at', [$start, $end]);
                    })
                    ->default([
                        'start' => now()->hour < 3
                            ? Carbon::yesterday()->hour(8)
                            : Carbon::today()->hour(8),
                        'end' => now()->hour < 3
                            ? Carbon::today()->hour(3)
                            : Carbon::tomorrow()->hour(3),
                    ]),
            ])
            ->paginated([60, 90, 120])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    EditAction::make()
                        ->label('Siparişi Düzenle')
                        ->modalHeading('Geçmiş Siparişi Düzenle')
                        ->modalButton('Değişiklikleri Kaydet')
                        ->form([
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('table_number')
                                        ->label('Masa Numarası')
                                        ->disabled()
                                        ->numeric(),
                                    TextInput::make('customer')
                                        ->label('Masada Oturan Müşteri Sayısı')
                                        ->required()
                                        ->suffix('Kişi')
                                        ->numeric(),
                                ]),
                            TextInput::make('device_info')
                                ->label('Müşterinin Sistemden Sipariş Verdiği Cihaz Bilgileri')
                                ->disabled(),
                            Grid::make(4)
                                ->schema([
                                    TextInput::make('credit_card')
                                        ->label('POS Tutarı')
                                        ->required()
                                        ->suffix('₺')
                                        ->numeric()
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                            $totalAmount = floatval($get('credit_card')) + floatval($get('cash_money')) + floatval($get('iban')) - floatval($get('ikram'));
                                            $set('total_amount', $totalAmount);
                                            $set('net_amount', $totalAmount * 0.92);
                                        }),
                                    TextInput::make('cash_money')
                                        ->label('Nakit Tutarı')
                                        ->required()
                                        ->suffix('₺')
                                        ->numeric()
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                            $totalAmount = floatval($get('credit_card')) + floatval($get('cash_money')) + floatval($get('iban')) - floatval($get('ikram'));
                                            $set('total_amount', $totalAmount);
                                            $set('net_amount', $totalAmount * 0.92);
                                        }),
                                    TextInput::make('iban')
                                        ->label('IBAN Tutarı')
                                        ->required()
                                        ->suffix('₺')
                                        ->numeric()
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                            $totalAmount = floatval($get('credit_card')) + floatval($get('cash_money')) + floatval($get('iban')) - floatval($get('ikram'));
                                            $set('total_amount', $totalAmount);
                                            $set('net_amount', $totalAmount * 0.92);
                                        }),
                                    TextInput::make('ikram')
                                        ->label('İkram Tutarı')
                                        ->helperText('ℹ️ Toplam Tutardan Eksiltilir.')
                                        ->required()
                                        ->prefix('-')
                                        ->suffix('₺')
                                        ->numeric()
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                            $totalAmount = floatval($get('credit_card')) + floatval($get('cash_money')) + floatval($get('iban')) - floatval($state);
                                            $set('total_amount', $totalAmount);
                                            $set('net_amount', $totalAmount * 0.92);
                                        }),
                                ]),
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('total_amount')
                                        ->label('Toplam Hesap Tutarı')
                                        ->helperText('ℹ️ Hesap Tutarı; POS, Nakit ve IBAN Toplamıdır.')
                                        ->required()
                                        ->suffix('₺')
                                        ->numeric()
                                        ->disabled()
                                        ->afterStateUpdated(function ($state, callable $set) {
                                            $set('net_amount', floatval($state) * 0.92);
                                        }),
                                    TextInput::make('net_amount')
                                        ->label('Net Hesap Tutarı (-%8 KDV)')
                                        ->required()
                                        ->suffix('₺')
                                        ->numeric()
                                        ->disabled(),
                                ]),
                        ])
                        ->action(function (PastOrder $record, array $data) {
                            $record->update($data);
                        })
                        ->visible(function (PastOrder $record) {
                            $start = Carbon::today()->addHours(7);
                            $end = Carbon::tomorrow()->addHours(3);
                            $createdAt = Carbon::parse($record->created_at);

                            return $createdAt->between($start, $end);
                        }),
                    Action::make('print_receipt')
                        ->label('Fiş Yazdır')
                        ->icon('heroicon-o-printer')
                        ->url(fn (PastOrder $record) => route('receipt.print', ['calculation' => $record->id]))
                        ->openUrlInNewTab()
                        ->visible(function (PastOrder $record) {
                            $start = Carbon::today()->addHours(7);
                            $end = Carbon::tomorrow()->addHours(3);
                            $createdAt = Carbon::parse($record->created_at);

                            return $createdAt->between($start, $end);
                        }),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPastOrders::route('/'),
        ];
    }
}
