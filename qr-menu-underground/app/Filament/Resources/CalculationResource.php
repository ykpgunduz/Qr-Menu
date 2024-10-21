<?php

namespace App\Filament\Resources;

use DB;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use App\Models\Category;
use Filament\Forms\Form;
use App\Models\OrderItem;
use Filament\Tables\Table;
use App\Models\Calculation;
use Illuminate\Validation\Rule;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Forms\Exceptions\ValidationException;
use App\Filament\Resources\CalculationResource\Pages;

class CalculationResource extends Resource
{
    protected static ?string $model = Calculation::class;

    protected static ?string $navigationGroup = 'Masalar ve Siparişler';

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    protected static ?string $pluralModelLabel = "Hesaplar";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('table_number')
                    ->label('Masa Numarası')
                    ->required()
                    ->numeric()
                    ->rules([
                        Rule::unique('calculations', 'table_number')
                            ->ignore(request()->route('record')),
                    ]),

                TextInput::make('order_number')
                    ->label('Sipariş Numarası')
                    ->required()
                    ->unique()
                    ->default(function () {
                        return 'ORD-' . strtoupper(uniqid());
                    })
                    ->disabled(fn (?Calculation $record) => $record !== null),

                Forms\Components\Grid::make(1)->schema([
                    Forms\Components\Repeater::make('order_items')
                        ->label('Siparişler')
                        ->relationship('orderItems')
                        ->schema([
                            Forms\Components\Grid::make(2)->schema([

                                Select::make('category_id')
                                    ->label('Kategori Seç')
                                    ->options(Category::all()->pluck('name', 'id'))
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $set('product_id', null);
                                    }),

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
                            ]),

                            Forms\Components\Grid::make(2)->schema([
                                TextInput::make('quantity')
                                    ->label('Miktar')
                                    ->required()
                                    ->default(1)
                                    ->numeric()
                                    ->minValue(1),
                                TextInput::make('price')
                                    ->label('Fiyat')
                                    ->required()
                                    ->numeric()
                                    ->readOnly(),
                            ]),

                            TextInput::make('note')
                                ->label('Sipariş Notu')
                                ->placeholder('opsiyonel')
                        ])
                        ->createItemButtonLabel('Yeni Ürün Ekle')
                        ->reorderableWithButtons()
                        ->grid(2),
                ])
            ]
        );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Calculation::query()->orderBy('table_number'))
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    TextColumn::make('table_number')
                        ->url(fn (Calculation $record) => 'https://harpysocial/admin/orders?tableFilters[table_number][value]=' . $record->table_number)
                        ->weight(FontWeight::Bold)
                        ->html()
                        ->formatStateUsing(fn ($state) => '<span style="font-size: 20px; font-weight: bold;">' . $state . '. Masa</span>'),
                        Grid::make(2)
                        ->schema([
                            TextColumn::make('total_amount')
                                ->label('Toplam Tutar')
                                ->html()
                                ->formatStateUsing(fn ($state) => '<span style="font-size: 20px;">' . number_format($state, 0) . '₺</span>'),

                            BadgeColumn::make('customer')
                                ->icon('heroicon-o-user')
                                ->iconPosition('after')
                        ])
                ])->space(3)
                ->extraAttributes(fn ($record) => [
                    'style' => match ($record->status) {
                        'Durgun' => 'box-shadow: 0px 0px 10px 5px rgba(255, 193, 7, 0.7); outline-offset: 10px; padding: 10px 0 15px 20px; margin-left: 15px;', // Sarı
                        'Hesap' => 'box-shadow: 0px 0px 15px 5px rgba(255, 0, 255, 0.7); outline-offset: 10px; padding: 10px 0 15px 20px; margin-left: 15px;', // Mor
                        'Aktif' => 'box-shadow: 0px 0px 10px 5px rgba(0, 255, 0, 0.7); outline-offset: 10px; padding: 10px 0 15px 20px; margin-left: 15px;', //Yeşil
                        'Pasif' => 'box-shadow: 0px 0px 10px 5px rgba(128, 128, 128, 0.7); outline-offset: 10px; padding: 10px 0 15px 20px; margin-left: 15px;', // Gri
                    },
                ]),
                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\Layout\Grid::make(1)
                        ->schema([
                            TextColumn::make('created_at')
                                ->label('Masa Açılışı')
                                ->formatStateUsing(fn ($state) => 'Masa Açılışı:<br>' . Carbon::parse($state)->diffForHumans())
                                ->html(),
                            TextColumn::make('updated_at')
                                ->label('Son Sipariş')
                                ->formatStateUsing(fn ($state) => 'Son sipariş:<br>' . Carbon::parse($state)->diffForHumans())
                                ->html(),
                        ]),
                ])->collapsible()
            ])
            ->poll('10s')
            ->filters([
                //
            ])
            ->contentGrid([
                'md' => 3,
                'xl' => 4,
            ])
            ->paginated([
                'all'
            ])
            ->actions([
                    Action::make('editCustomerCount')
                        ->label('Kişi')
                        ->icon('heroicon-o-user')
                        ->form([
                            Forms\Components\TextInput::make('customer')
                                ->label('Kişi Sayısı')
                                ->required()
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(50)
                        ])
                        ->action(function (Calculation $record, array $data) {
                            $record->customer = $data['customer'];
                            $record->save();
                        })
                        ->color('primary')
                        ->visible(fn (Calculation $record) => $record->status !== 'Ödendi'),

                    DeleteAction::make()
                        ->label('Sil')
                        ->icon('heroicon-o-x-circle')
                        ->visible(fn ($record) => $record->total_amount == 0)
                        ->modalHeading('Bu Masayı Silmek İstiyor musunuz?')
                        ->modalSubheading('Bu işlem geri alınamaz, masa komple silinecektir.')
                        ->modalButton('Evet, Sil'),

                    Action::make('payment')
                        ->label('Hesap')
                        ->icon('heroicon-o-banknotes')
                        ->visible(fn ($record) => $record->total_amount > 0)
                        ->requiresConfirmation()
                        ->modalHeading('Ödeme İşlemini Onaylıyor musunuz?')
                        ->modalSubheading('Onaylarsanız veriler ödenen siparişlere kaydedilecek')
                        ->modalButton('Onayla')
                        ->form(function (Calculation $record) {
                            $formFields = [
                                Forms\Components\Radio::make('payment_method')
                                    ->label('Ödeme Yöntemi')
                                    ->required()
                                    ->options([
                                        'POS' => 'POS',
                                        'Nakit' => 'Nakit',
                                        'IBAN' => 'IBAN',
                                    ])
                                    ->inline(),

                                TextInput::make('payment_amount')
                                    ->label('Ödenecek Hesap Tutarı: ' . number_format($record->total_amount) . '₺')
                                    ->required()
                                    ->numeric()
                                    ->suffix('₺')
                                    ->minValue(1)
                                    ->maxValue($record->total_amount),

                                Forms\Components\Toggle::make('pay_full')
                                    ->label('Hesabın Tamamını Seç')
                                    ->default(false)
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) use ($record) {
                                        if ($state) {
                                            $set('payment_amount', $record->total_amount);
                                        } else {
                                            $set('payment_amount', null);
                                        }
                                    }),
                            ];

                            if (is_null($record->customer)) {
                                $formFields[] = TextInput::make('customer_count')
                                    ->label('Kişi Sayısı')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(20);
                            }

                            return $formFields;
                        })
                        ->action(function (Calculation $record, array $data) {
                            $paymentAmount = $data['payment_amount'];
                            $paymentMethod = $data['payment_method'];
                            $customerCount = $data['customer_count'] ?? $record->customer; // Mevcut müşteri sayısını al veya kullanıcıdan alınan değeri kullan

                            if ($paymentAmount > $record->total_amount) {
                                Notification::make()
                                    ->title('Hata')
                                    ->body('Ödeme tutarı mevcut hesap tutarından fazla olamaz.')
                                    ->danger()
                                    ->send();
                                return;
                            }

                            if (is_null($record->customer)) {
                                $record->customer = $customerCount;
                                $record->save();
                            }

                            DB::table('past_orders')->updateOrInsert(
                                [
                                    'order_number' => $record->order_number,
                                ],
                                [
                                    'table_number' => $record->table_number,
                                    'session_id' => $record->session_id,
                                    'total_amount' => DB::raw('IFNULL(total_amount, 0) + ' . $paymentAmount),
                                    'net_amount' => DB::raw('IFNULL(net_amount, 0) + (' . $paymentAmount . ' * 0.92)'),
                                    'device_info' => $record->device_info,
                                    'note' => $record->note ?? '-',
                                    'customer' => $customerCount,
                                    'products' => $record->orderItems->map(function ($item) {
                                        return $item->quantity . ' x ' . Product::find($item->product_id)->title . ' - ' . $item->price . '₺';
                                    })->implode(', '),
                                    'quantity' => $record->orderItems->sum('quantity'),
                                    'credit_card' => $paymentMethod === 'POS' ? DB::raw('IFNULL(credit_card, 0) + ' . $paymentAmount) : DB::raw('IFNULL(credit_card, 0)'),
                                    'cash_money' => $paymentMethod === 'Nakit' ? DB::raw('IFNULL(cash_money, 0) + ' . $paymentAmount) : DB::raw('IFNULL(cash_money, 0)'),
                                    'iban' => $paymentMethod === 'IBAN' ? DB::raw('IFNULL(iban, 0) + ' . $paymentAmount) : DB::raw('IFNULL(iban, 0)'),
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]
                            );

                            $record->total_amount -= $paymentAmount;
                            $record->save();

                            if ($record->total_amount <= 0) {
                                $record->delete();
                            }

                            Notification::make()
                                ->title('Ödeme Başarılı')
                                ->body($paymentAmount . '₺ ödeme alındı. Kalan hesap tutarı: ' . $record->total_amount . '₺')
                                ->success()
                                ->send();
                        })
                        ->modalButton('Ödemeyi Kaydet')
                        ->color('success'),

                        ActionGroup::make([
                            Action::make('editTableNumber')
                                ->label('Bu Masayı Taşı')
                                ->icon('heroicon-o-pencil')
                                ->form([
                                    TextInput::make('table_number')
                                        ->label('Masanın hesabı ve sipariş verileri gireceğiniz masaya taşınacaktır.')
                                        ->required()
                                        ->numeric()
                                        ->rules([
                                            Rule::unique('calculations', 'table_number')
                                                ->ignore(request()->route('record')),
                                        ]),
                                ])
                                ->action(function (Calculation $record, array $data) {
                                    $oldTableNumber = $record->table_number;
                                    $newTableNumber = $data['table_number'];

                                    DB::transaction(function () use ($oldTableNumber, $newTableNumber) {
                                        $oldRecord = Calculation::where('table_number', $oldTableNumber)->first();

                                        if (!$oldRecord) {
                                            throw new \Exception("Masa $oldTableNumber bulunamadı.");
                                        }

                                        $newRecord = Calculation::create([
                                            'table_number' => $newTableNumber,
                                            'total_amount' => $oldRecord->total_amount,
                                            'customer' => $oldRecord->customer,
                                            'status' => $oldRecord->status,
                                            'session_id' => $oldRecord->session_id,
                                            'device_info' => $oldRecord->device_info,
                                            'note' => $oldRecord->note,
                                            'created_at' => $oldRecord->created_at,
                                            'updated_at' => now(),
                                        ]);

                                        $orderItems = OrderItem::where('table_number', $oldTableNumber)->get();

                                        foreach ($orderItems as $item) {
                                            OrderItem::create([
                                                'table_number' => $newTableNumber,
                                                'product_id' => $item->product_id,
                                                'quantity' => $item->quantity,
                                                'price' => $item->price,
                                                'created_at' => $item->created_at,
                                                'updated_at' => now(),
                                            ]);
                                        }

                                        OrderItem::where('table_number', $oldTableNumber)->delete();

                                        $oldRecord->delete();
                                    });
                                })
                                ->modalButton('Onayla')
                                ->color('primary'),

                            Action::make('suspendTableNumber')
                                ->label('Masayı Askıya Al')
                                ->icon('heroicon-o-arrow-down-tray')
                                ->form([
                                    TextInput::make('table_number')
                                        ->label('Askıya almak istediğiniz masayı 50 den büyük bir masa sayısına taşıyınız.')
                                        ->required()
                                        ->numeric()
                                        ->minValue(50)
                                        ->rules([
                                            Rule::unique('calculations', 'table_number')
                                                ->ignore(request()->route('record')),
                                        ]),
                                ])
                                ->action(function (Calculation $record, array $data) {
                                    $oldTableNumber = $record->table_number;
                                    $newTableNumber = $data['table_number'];

                                    DB::transaction(function () use ($oldTableNumber, $newTableNumber) {
                                        $oldRecord = Calculation::where('table_number', $oldTableNumber)->first();

                                        if (!$oldRecord) {
                                            throw new \Exception("Masa $oldTableNumber bulunamadı.");
                                        }

                                        $newRecord = Calculation::create([
                                            'table_number' => $newTableNumber,
                                            'total_amount' => $oldRecord->total_amount,
                                            'customer' => $oldRecord->customer,
                                            'status' => 'Pasif',
                                            'session_id' => $oldRecord->session_id,
                                            'device_info' => $oldRecord->device_info,
                                            'note' => $oldRecord->note,
                                            'created_at' => $oldRecord->created_at,
                                            'updated_at' => now(),
                                        ]);

                                        $orderItems = OrderItem::where('table_number', $oldTableNumber)->get();

                                        foreach ($orderItems as $item) {
                                            OrderItem::create([
                                                'table_number' => $newTableNumber,
                                                'product_id' => $item->product_id,
                                                'quantity' => $item->quantity,
                                                'price' => $item->price,
                                                'created_at' => $item->created_at,
                                                'updated_at' => now(),
                                            ]);
                                        }

                                        OrderItem::where('table_number', $oldTableNumber)->delete();

                                        $oldRecord->delete();
                                    });
                                })
                                ->modalButton('Onayla')
                                ->color('warning'),
                        ])
                ])
            ->bulkActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCalculations::route('/'),
            'create' => Pages\CreateCalculation::route('/create'),
            'edit' => Pages\EditCalculation::route('/{record}/edit'),
        ];
    }
}
