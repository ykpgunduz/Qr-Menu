<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Cancel;
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
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\OrderResource\Pages;

class OrderResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?string $navigationGroup = 'Masalar ve Sipariş Yönetimi';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $pluralModelLabel = "Aktif Siparişler";

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
                        ->required(),
                    Select::make('product_id')
                        ->label('Ürün Seç')
                        ->options(function (callable $get) {
                            $categoryId = $get('category_id');
                            return Product::where('category_id', $categoryId)->pluck('title', 'id');
                        })
                        ->searchable()
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set, callable $get) {
                            $quantity = $get('quantity') ?? 1;
                            $calculationId = $get('calculation_id');
                            $product = Product::find($state);

                            if ($product && $calculationId) {
                                $totalPrice = $product->price * $quantity;
                                $set('price', $product->price);
                                $set('total_price', $totalPrice);

                                $calculation = Calculation::find($calculationId);
                                if ($calculation) {
                                    $calculation->total_amount += $totalPrice;
                                    $calculation->save();
                                }
                            }
                        }),
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
                    ->label('Fiyat')
                    ->suffix('₺'),
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
                    ->titlePrefixedWithLabel(false)
                    ->getTitleFromRecordUsing(function ($record) {
                        $calculation = Calculation::where('table_number', $record->table_number)->first();
                        return 'Masa ' . $record->table_number . ($calculation ? ' - ' . $calculation->status . ' Servis' : '');
                    })
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
                        ->modalButton('Siparişi Kaydet')
                        ->color('warning')
                        ->icon('heroicon-o-pencil-square')
                        ->form([
                            ToggleButtons::make('status')
                                ->label('Sipariş Durumu')
                                ->required()
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
                            Forms\Components\Grid::make(2)->schema([
                                TextInput::make('quantity')
                                    ->label('Miktar')
                                    ->disabled()
                                    ->suffix('Adet'),
                                Select::make('product_id')
                                    ->label('Ürün Bilgisi')
                                    ->disabled()
                                    ->options(Product::all()->pluck('title', 'id'))
                            ]),
                            TextInput::make('note')
                                ->label('Sipariş Notu')
                        ])
                        ->action(function (OrderItem $record, array $data) {
                            $record->update($data);
                        }),
                    Tables\Actions\Action::make('cancel')
                        ->label('İptal Et / İade Et')
                        ->color('danger')
                        ->icon('heroicon-o-x-circle')
                        ->action(function (OrderItem $record, array $data) {
                            Cancel::create([
                                'table_number' => $record->calculation->table_number,
                                'status' => $data['status'],
                                'product_info' => $record->quantity . ' Adet ' . $record->product->title,
                                'description' => $data['description'],
                            ]);

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
                        ->form([
                            ToggleButtons::make('status')
                                ->label('Sipariş Durumunu Seçiniz')
                                ->options([
                                    'İptal' => 'İptal Et',
                                    'İade' => 'İade Et',
                                ])
                                ->icons([
                                    'İptal' => 'heroicon-o-x-circle',
                                    'İade' => 'heroicon-o-backspace',
                                ])
                                ->colors([
                                    'İptal' => 'danger',
                                    'İade' => 'warning',
                                ])
                                ->inline()
                                ->required()
                                ->validationMessages(['required' => '⚠️ İptal / İade durumunu seçiniz.']),
                            TextInput::make('product_info')
                                ->label('Ürün Bilgisi')
                                ->default(function ($record) {
                                    return $record->quantity . ' Adet ' . $record->product->title;
                                })
                                ->disabled(),
                            TextInput::make('description')
                                ->label('Açıklama')
                                ->placeholder('İptal veya iade sebebini girin')
                                ->required(),
                        ])
                        ->modalHeading('Siparişi İptal Et veya İade Et')
                        ->modalSubheading('Bu işlem geri alınamaz. Sipariş iptal edilecek veya iade edilecektir.')
                        ->modalButton('Onayla')
                ]),
            ])
            ->paginated(['all']);
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
