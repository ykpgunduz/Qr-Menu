<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\Cancel;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CancelResource\Pages;

class CancelResource extends Resource
{
    protected static ?string $model = Cancel::class;

    protected static ?string $pluralModelLabel = "İptal - İade İşlemleri";

    protected static ?string $navigationIcon = 'heroicon-o-archive-box-x-mark';

    protected static ?string $navigationGroup = 'Masalar ve Sipariş Yönetimi';
    protected static ?int $navigationSort = 4;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('table_number')
                    ->label('Masa')
                    ->formatStateUsing(fn ($state) => $state . '. Masa'),
                TextColumn::make('status')
                    ->label('Durum'),
                BadgeColumn::make('status')
                    ->label('Durum')
                    ->icons([
                        'heroicon-o-x-circle' => 'İptal',
                        'heroicon-o-backspace' => 'İade',
                    ])
                    ->colors([
                        'danger' => 'İptal',
                        'warning' => 'İade',
                    ])
                    ->formatStateUsing(fn ($state) =>
                        match ($state) {
                            'İade' => 'İADE',
                            'İptal' => 'İPTAL',
                            default => $state,
                        }
                    ),
                TextColumn::make('product_info')
                    ->label('Ürün Bilgisi'),
                TextColumn::make('description')
                    ->label('Açıklama'),
                TextColumn::make('created_at')
                    ->label('Saat ve Tarih')
                    ->dateTime('H:i | d/m/y'),
            ])
            ->paginated(['all'])
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
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCancels::route('/'),
        ];
    }
}
