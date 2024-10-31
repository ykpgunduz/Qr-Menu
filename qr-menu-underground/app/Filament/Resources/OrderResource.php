<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use App\Models\Category;
use Filament\Forms\Form;
use App\Models\OrderItem;
use Filament\Tables\Table;
use App\Models\Calculation;
use Filament\Resources\Resource;
use Filament\Tables\Grouping\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\OrderResource\Pages;

class OrderResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?string $navigationGroup = 'Masalar ve Siparişler';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $pluralModelLabel = "Açık Masalar";

    public static function getNavigationBadge(): ?string
    {
        $count = OrderItem::where('status', 'Yeni Sipariş')->count();
        return $count > 0 ? (string) $count . ' Yeni Sipariş' : null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)->schema([
                    Select::make('calculation_id')
                        ->label('Masa Seç')
                        ->prefix('Masa No:')
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

                    Select::make('category_id')
                        ->label('Kategori Seç')
                        ->options(Category::all()->pluck('name', 'id'))
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            $set('product_id', null);
                        }),

                    TextInput::make('note')
                        ->label('Sipariş Notu')
                        ->placeholder('opsiyonel'),

                        TextInput::make('quantity')
                        ->label('Miktar')
                        ->numeric()
                        ->suffix('adet')
                        ->default(1)
                        ->minValue(1)
                        ->maxValue(20)
                        ->reactive()
                        ->required()
                        ->afterStateUpdated(fn ($state, callable $set, callable $get) =>
                            $set('total_price', $get('price') * $state)
                        ),

                    Select::make('product_id')
                        ->label('Ürün Seç')
                        ->options(function (callable $get) {
                            $categoryId = $get('category_id');
                            return Product::where('category_id', $categoryId)->pluck('title', 'id');
                        })
                        ->searchable()
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn ($state, callable $set) => $set('price', Product::find($state)?->price)),


                    TextInput::make('price')
                        ->label('Ürün Fiyatı')
                        ->numeric()
                        ->suffix('₺')
                        ->readOnly()
                        ->required(),

                ]),

                Hidden::make('table_number')
                    ->default(fn () => null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('quantity')
                    ->label('Miktar')
                    ->suffix(' adet'),
                TextColumn::make('product.title')
                    ->label('Ürün Adı'),
                TextColumn::make('product.price')
                    ->label('Ürün Fiyatı')
                    ->suffix('₺')
                    ->toggleable(isToggledHiddenByDefault: true),
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
                        if ($currentStatus === 'Teslim Edildi') {}
                        else { $record->update([ 'status' => $nextStatus]); }
                    }),
                TextColumn::make('created_at')
                    ->label('Saat ve Tarih')
                    ->dateTime('H:i | d/m'),
                TextColumn::make('note')
                    ->label('Sipariş Notu'),
            ])
            ->poll('10s')
            ->groups([
                Group::make('table_number')
                ->label('Masa')
            ])
            ->defaultGroup('table_number')
            ->groupingSettingsHidden()
            ->filters([
                SelectFilter::make('table_number')
                    ->label('Masa Numarası')
                    ->relationship('calculation', 'table_number')
                    ->options('table_number')
                    ->searchable()
                    ->preload()
                    ->placeholder('Masa Numarası Seçin')
                    ->column('table_number')
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    EditAction::make()
                        ->label('Siparişi Düzenle')
                        ->modalHeading('Siparişi Düzenle')
                        ->modalButton('Kaydet')
                        ->form([
                            ToggleButtons::make('status')
                                ->label('Sipariş Durumu')
                                ->options([
                                    'Yeni Sipariş' => 'Yeni Sipariş',
                                    'Hazırlanıyor' => 'Hazırlanıyor',
                                    'Teslim Edildi' => 'Teslim Edildi'
                                ])->default(fn ($record) => $record->status)
                                ->icons([
                                    'Yeni Sipariş' => 'heroicon-o-sparkles',
                                    'Hazırlanıyor' => 'heroicon-o-clock',
                                    'Teslim Edildi' => 'heroicon-o-check-circle',
                                ])
                                ->colors([
                                    'Yeni Sipariş' => 'info',
                                    'Hazırlanıyor' => 'warning',
                                    'Teslim Edildi' => 'success',
                                ])->inline(),
                            TextInput::make('quantity')
                                ->label('Miktar')
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(20)
                                ->default(1),
                            Select::make('product_id')
                                ->label('Ürün Seç')
                                ->options(Product::all()->pluck('title', 'id'))
                                ->required()
                                ->searchable(),
                            TextInput::make('note')
                                ->label('Sipariş Notu')
                        ])
                        ->action(function (OrderItem $record, array $data) {
                            $record->update($data);
                        }),
                        Tables\Actions\DeleteAction::make()
                        ->label('Bu Siparişi Sil')
                        ->action(function (OrderItem $record) {
                            $calculation = Calculation::where('table_number', $record->calculation->table_number)->first();
                            if ($calculation) {
                                $amountToDeduct = $record->price * $record->quantity;
                                $calculation->total_amount -= $amountToDeduct;
                                if ($calculation->total_amount < 0) {
                                    $calculation->total_amount = 0;
                                }
                                $calculation->save();
                            }
                            $record->delete();
                        })
                        ->modalHeading('Bu siparişi silmek istiyor musunuz?')
                        ->modalSubheading('Bu işlem geri alınamaz, sadece bu sipariş silinecektir.')
                        ->modalButton('Evet, Sil'),
                ]),
            ])
            ->paginated(['all'])
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
