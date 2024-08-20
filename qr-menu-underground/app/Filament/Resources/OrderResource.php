<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use App\Models\OrderItem;
use Filament\Tables\Table;
use App\Models\Calculation;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrderResource\Pages;

class OrderResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?string $navigationGroup = 'Masalar ve Siparişler';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $pluralModelLabel = "Siparişler";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('calculation_id')
                    ->label('Masa Seç')
                    ->options(Calculation::all()->pluck('table_number', 'id'))
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $calculation = Calculation::find($state);
                        if ($calculation) {
                            $set('table_number', $calculation->table_number);
                        }
                    }),

                Select::make('product_id')
                    ->label('Ürün Seç')
                    ->options(Product::all()->pluck('title', 'id'))
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('price', Product::find($state)?->price)),

                TextInput::make('quantity')
                    ->label('Miktar')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(20)
                    ->default(1)
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set, callable $get) => $set('total_price', $get('price') * $state)),

                TextInput::make('price')
                    ->label('Ürün Fiyatı')
                    ->numeric()
                    ->readOnly()
                    ->required(),

                TextInput::make('note')
                    ->label('Sipariş Notu')
                    ->nullable(),

                Hidden::make('table_number')
                    ->default(fn () => null),
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
                        'success' => 'Teslim Edildi'
                    ])
                    ->icons([
                        'heroicon-o-sparkles' => 'Yeni Sipariş',
                        'heroicon-o-clock' => 'Hazırlanıyor',
                        'heroicon-o-check-circle' => 'Teslim Edildi'
                    ])
                    ->action(function ($record, $column) {
                        $currentStatus = $record->status;
                        $nextStatus = self::getNextStatus($currentStatus);

                        $record->update([
                            'status' => $nextStatus,
                        ]);
                    }),
                TextColumn::make('created_at')
                    ->label('Saat ve Tarih')
                    ->dateTime('H:i | d/m'),
                TextColumn::make('calculation.note')
                    ->label('Sipariş Notu'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    EditAction::make()
                        ->label('Siparişi Düzenle')
                        ->modalHeading('Siparişi Düzenle')
                        ->modalButton('Kaydet')
                        ->form([
                            TextInput::make('quantity')
                                ->label('Miktar')
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(20)
                                ->default(1),
                            Select::make('product_id')
                                ->label('Ürün Seç')
                                ->options(Product::all()->pluck('title', 'id'))
                                ->required(),
                        ])
                        ->action(function (OrderItem $record, array $data) {
                            $record->update($data);
                        }),
                    Tables\Actions\DeleteAction::make()
                        ->label('Bu Siparişi Sil')
                        ->action(function (OrderItem $record) {
                            $amountToDeduct = $record->price;

                            $calculation = Calculation::where('id', $record->order_id)->first();

                            if ($calculation) {
                                $calculation->total_amount -= $amountToDeduct;
                                $calculation->save();
                            }

                            $record->delete();
                        }),
                ]),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
        ];
    }

    protected static function getNextStatus($currentStatus)
    {
        $statuses = [
            'Yeni Sipariş' => 'Hazırlanıyor',
            'Hazırlanıyor' => 'Teslim Edildi',
        ];

        return $statuses[$currentStatus] ?? 'Yeni Sipariş';
    }
}
