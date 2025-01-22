<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Rating;
use App\Models\PastOrder;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RatingResource\Pages;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;

    protected static ?string $pluralModelLabel = "Müşteri Anketleri";

    protected static ?string $navigationGroup = 'Kafe ve Menü İçerik Yönetimi';

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BadgeColumn::make('order_number')
                    ->label(__('Sipariş Numarası'))
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('service_rating')
                    ->label(__('Hizmet'))
                    ->sortable()
                    ->color(fn ($state) => match (true) {
                        $state >= 4 => 'success',
                        $state == 3 => 'warning',
                        $state <= 2 => 'danger',
                    })
                    ->icon(icon: 'heroicon-o-star'),

                Tables\Columns\BadgeColumn::make('product_rating')
                    ->label(__('Ürün'))
                    ->sortable()
                    ->color(fn ($state) => match (true) {
                        $state >= 4 => 'success',
                        $state == 3 => 'warning',
                        $state <= 2 => 'danger',
                    })
                    ->icon(icon: 'heroicon-o-star'),

                Tables\Columns\BadgeColumn::make('ambiance_rating')
                    ->label(__('Ortam'))
                    ->sortable()
                    ->color(fn ($state) => match (true) {
                        $state >= 4 => 'success',
                        $state == 3 => 'warning',
                        $state <= 2 => 'danger',
                    })
                    ->icon(icon: 'heroicon-o-star'),

                Tables\Columns\BadgeColumn::make('return_response')
                    ->label(__('Dönüş'))
                    ->color(fn ($state) => $state === 'yes' ? 'success' : 'danger')
                    ->formatStateUsing(fn ($state) => $state === 'yes' ? __('Evet') : __('Hayır'))
                    ->icon(fn ($state) => $state === 'yes' ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                    ->sortable(),

                Tables\Columns\TextColumn::make('additional_comments')
                    ->label(__('Açıklama'))
                    ->wrap()
                    ->limit(30),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Saat ve Tarih'))
                    ->dateTime('H:i | d.m.y')
                    ->sortable()
                    ->color('gray'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('low_service_rating')
                    ->label('Düşük Hizmet Puanı (1-3)')
                    ->query(fn (Builder $query) => $query->where('service_rating', '<=', 3)),

                Filter::make('low_product_rating')
                    ->label('Düşük Ürün Puanı (1-3)')
                    ->query(fn (Builder $query) => $query->where('product_rating', '<=', 3)),

                Filter::make('low_ambiance_rating')
                    ->label('Düşük Ortam Puanı (1-3)')
                    ->query(fn (Builder $query) => $query->where('ambiance_rating', '<=', 3)),
            ])
            ->paginated([30, 60, 90])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->action(function (Rating $record, array $data) {
                        $record->update($data);
                    })
                    ->form([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('order_number')
                                    ->label('Sipariş Numarası')
                                    ->default(fn ($record) => $record->order_number)
                                    ->disabled(),
                                TextInput::make('past_order_table')
                                    ->label('Masa Numarası')
                                    ->default(fn ($record) => $record->pastOrder?->table_number . '. Masa' ?? 'Masa numarası bulunamadı')
                                    ->disabled(),
                                TextInput::make('past_order_user')
                                    ->label('Masada Oturan Kişi Sayısı')
                                    ->default(fn ($record) => $record->pastOrder?->customer . ' Kişi' ?? 'Müşteri sayısı bulunamadı')
                                    ->disabled(),
                            ]),
                        TextInput::make('past_order_products')
                            ->label('Masanın Siparişleri')
                            ->default(fn ($record) => $record->pastOrder?->products ?? 'Ürün bilgisi bulunamadı')
                            ->disabled(),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('past_order_created_at')
                                    ->label('Masanın Siparişleri')
                                    ->default(fn ($record) => $record->pastOrder?->created_at?->format('H:i | d.m.Y') ?? 'Tarih ve Saat bilgisi bulunamadı')
                                    ->disabled(),
                                TextInput::make('past_order_updated_at')
                                    ->label('Masanın Siparişleri')
                                    ->default(fn ($record) => $record->pastOrder?->updated_at?->format('H:i | d.m.Y') ?? 'Tarih ve Saat bilgisi bulunamadı')
                                    ->disabled(),
                            ]),

                        Grid::make(4)
                            ->schema([
                                TextInput::make('service_rating')
                                    ->label('Size verilen servisten memnun kaldınız mı?')
                                    ->default(fn ($record) => '★ ' . $record->service_rating)
                                    ->disabled(),
                                TextInput::make('product_rating')
                                    ->label('Size servis edilen ürünlerden memnun kaldınız mı?')
                                    ->default(fn ($record) => '★ ' . $record->product_rating)
                                    ->disabled(),
                                TextInput::make('ambiance_rating')
                                    ->label('İşletmenin genel ambiansı (müzik, temizlik vs.) nasıldı?')
                                    ->default(fn ($record) => '★ ' . $record->ambiance_rating)
                                    ->disabled(),

                                Select::make('return_response')
                                    ->label('Tekrar bu işletmeye gelir misiniz?')
                                    ->options([
                                        'yes' => 'Evet',
                                        'no' => 'Hayır',
                                    ])
                                    ->default(fn ($record) => $record->return_response)
                                    ->disabled(),
                            ]),
                        Textarea::make('additional_comments')
                            ->label('Açıklama')
                            ->default(fn ($record) => $record->additional_comments)
                            ->disabled(),
                    ])
                    ->modalButton('★'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRatings::route('/'),
        ];
    }
}
