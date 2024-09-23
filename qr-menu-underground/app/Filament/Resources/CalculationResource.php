<?php

namespace App\Filament\Resources;

use DB;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use App\Models\OrderItem;
use Filament\Tables\Table;
use App\Models\Calculation;
use Illuminate\Validation\Rule;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Forms\Exceptions\ValidationException;
use App\Filament\Resources\CalculationResource\Pages;
use Illuminate\Support\HtmlString; // En üste ekleyin

class CalculationResource extends Resource
{
    protected static ?string $model = Calculation::class;

    protected static ?string $navigationGroup = 'Masalar ve Siparişler';

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    protected static ?string $pluralModelLabel = "Masalar";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('table_number')
                    ->label('Masa Numarası')
                    ->required()
                    ->numeric()
                    ->rules([
                        Rule::unique('calculations', 'table_number')
                            ->ignore(request()->route('record')),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    TextColumn::make('table_number')
                        ->label('Masa Numarası')
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
                        'Hesap' => 'box-shadow: 0px 0px 10px 5px rgba(255, 193, 7, 0.7); outline-offset: 10px; padding: 15px;',
                        'Aktif' => 'box-shadow: 0px 0px 10px 5px rgba(0, 255, 0, 0.7); outline-offset: 10px; padding: 15px;',
                        'Masa Askıda' => 'box-shadow: 0px 0px 10px 5px rgba(128, 0, 128, 0.7); outline-offset: 10px; padding: 15px;', // Purple color
                    },
                ]),
                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\Layout\Grid::make(1)
                        ->schema([
                            TextColumn::make('created_at')
                                ->label('İlk Sipariş')
                                ->formatStateUsing(fn ($state) => 'İlk sipariş:<br>' . Carbon::parse($state)->diffForHumans())
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
                'md' => 4,
                'xl' => 4,
            ])
            ->paginated([
                18,
                36,
                72,
                'all',
            ])
            ->actions([
                    Tables\Actions\Action::make('editCustomerCount')
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

                    Tables\Actions\DeleteAction::make()
                        ->label('Masayı Sil')
                        ->icon('heroicon-o-x-circle')
                        ->visible(fn ($record) => $record->total_amount == 0)
                        ->modalHeading('Bu Masayı Silmek İstiyor musunuz?')
                        ->modalSubheading('Bu işlem geri alınamaz, masa komple silinecektir.')
                        ->modalButton('Evet, Sil'),

                        Tables\Actions\Action::make('markAsPaid')
                        ->label('Ödendi')
                        ->icon('heroicon-o-banknotes')
                        ->color('warning')
                        ->visible(fn ($record) => $record->total_amount > 0)
                        ->requiresConfirmation()
                        ->modalHeading('Ödeme İşlemini Onaylıyor musunuz?')
                        ->modalSubheading('Onaylarsanız veriler ödenen siparişlere kaydedilecek')
                        ->modalButton('Onayla')
                        ->form([
                            Forms\Components\Radio::make('payment_method')
                                ->label('Ödeme Yöntemi:')
                                ->required()
                                ->options([
                                    'POS' => 'POS',
                                    'Nakit' => 'Nakit',
                                ])
                                ->inline(),
                        ])
                        ->action(function (Calculation $record, array $data) {
                            $productDetails = $record->orderItems->map(function ($item) {
                                $productName = DB::table('products')
                                    ->where('id', $item->product_id)
                                    ->value('title');

                                return $item->quantity . ' x ' . $productName . ' - ' . $item->price . '₺';
                            })->implode(', ');

                            $totalAmount = $record->total_amount;
                            $paymentMethod = $data['payment_method'];
                            $posAmount = $paymentMethod === 'POS' ? $totalAmount : 0;
                            $cashAmount = $paymentMethod === 'Nakit' ? $totalAmount : 0;

                            DB::table('past_orders')->insert([
                                'table_number' => $record->table_number,
                                'session_id' => $record->session_id,
                                'total_amount' => $totalAmount,
                                'device_info' => $record->device_info,
                                'note' => $record->note ?? '-',
                                'customer' => $record->customer,
                                'products' => $productDetails,
                                'quantity' => $record->orderItems->sum('quantity'),
                                'credit_card' => $posAmount,
                                'cash_money' => $cashAmount,
                                'created_at' => $record->created_at,
                                'updated_at' => now(),
                            ]);

                            $record->delete();
                        })
                        ->color('warning')
                        ->visible(fn ($record) => $record->total_amount > 0),
                        
                        ActionGroup::make([
                            Tables\Actions\Action::make('editTableNumber')
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
                                        // 1. Mevcut calculation kaydını al
                                        $oldRecord = Calculation::where('table_number', $oldTableNumber)->first();

                                        if (!$oldRecord) {
                                            throw new \Exception("Masa $oldTableNumber bulunamadı.");
                                        }

                                        // 2. Yeni bir calculation kaydı oluştur
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

                                        // 3. Order items'i kopyala
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

                                        // 4. Eski order items'i sil
                                        OrderItem::where('table_number', $oldTableNumber)->delete();

                                        // 5. Eski calculation kaydını sil
                                        $oldRecord->delete();
                                    });
                                })
                                ->modalButton('Onayla')
                                ->color('primary'),

                                Tables\Actions\Action::make('partialPayment')
                                ->label('Parçalı Ödeme')
                                ->icon('heroicon-o-banknotes')
                                ->form([
                                    TextInput::make('cash_amount')
                                        ->label('Nakit Tutarı')
                                        ->numeric()
                                        ->required()
                                        ->minValue(0),
                                    TextInput::make('card_amount')
                                        ->label('Kart Tutarı')
                                        ->numeric()
                                        ->required()
                                        ->minValue(0),
                                ])
                                ->action(function (Calculation $record, array $data) {
                                    $cash_amount = $data['cash_amount'];
                                    $card_amount = $data['card_amount'];

                                    $totalPaid = $data['cash_amount'] + $data['card_amount'];

                                    if ($totalPaid > $record->total_amount) {
                                        Notification::make()
                                            ->title('Hata')
                                            ->body('Ödeme toplam tutarı aşamaz.')
                                            ->danger()
                                            ->send();
                                        return;
                                    }

                                    if ($totalPaid < $record->total_amount) {
                                        Notification::make()
                                            ->title('Hata')
                                            ->body('Ödeme toplam tutardan az olamaz.')
                                            ->danger()
                                            ->send();
                                        return;
                                    }

                                    Notification::make()
                                        ->title('Ödeme Başarılı')
                                        ->body($card_amount . '<br>' . $cash_amount)
                                        ->success()
                                        ->send();

                                    DB::table('past_orders')->insert([
                                        'table_number' => $record->table_number,
                                        'session_id' => $record->session_id,
                                        'total_amount' => $record->total_amount,
                                        'device_info' => $record->device_info,
                                        'note' => $record->note ?? '-',
                                        'customer' => $record->customer,
                                        'products' => $record->orderItems->map(function ($item) {
                                            return $item->quantity . ' x ' . Product::find($item->product_id)->title . ' - ' . $item->price . '₺';
                                        })->implode(', '),
                                        'quantity' => $record->orderItems->sum('quantity'),
                                        'credit_card' => $card_amount,
                                        'cash_money' => $cash_amount,
                                        'created_at' => now(),
                                        'updated_at' => now(),
                                    ]);
                                        $record->delete();
                                })
                                ->modalButton('Ödemeyi Kaydet')
                                ->color('success'),

                                Tables\Actions\Action::make('partialDeductPayment')
                            ->label('Eksiltmeli Ödeme')
                            ->icon('heroicon-o-minus-circle')
                            ->form([
                                TextInput::make('deduction_amount')
                                    ->label('Eksiltilecek Tutar')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0),
                            ])
                            ->action(function (Calculation $record, array $data) {
                                $orderItems = $record->orderItems;

                                // Her bir ürünün toplam değeri alınarak toplam tutar hesaplanıyor
                                $originalTotalAmount = $orderItems->sum(function ($item) {
                                    return $item->quantity * $item->price;
                                });

                                // Mevcut toplam tutarı al (eğer kısmi ödeme yapıldıysa güncel total_amount bu olacaktır)
                                $currentTotalAmount = $record->total_amount;

                                // Eğer mevcut $currentTotalAmount eşit değilse (ilk hesaplamada yanlış atanım olabilir)
                                if ($record->total_amount !== $originalTotalAmount) {
                                    $record->total_amount = $originalTotalAmount;
                                    $record->save();
                                }

                                $deductionAmount = $data['deduction_amount'];

                                if ($deductionAmount > $currentTotalAmount) {
                                    Notification::make()
                                        ->title('Hata')
                                        ->body('Eksiltilecek tutar toplam ödemeden fazla olamaz.')
                                        ->danger()
                                        ->send();
                                    return;
                                }

                                // Eksiltme operasyonu
                                $remainingAmount = $currentTotalAmount - $deductionAmount;

                                if ($remainingAmount <= 0) {
                                    // Eğer şimdi kalan tutar sıfır veya daha az ise
                                    $productDetails = $orderItems->map(function ($item) {
                                        return $item->quantity . ' x ' . Product::find($item->product_id)->title . ' - ' . $item->price . '₺';
                                    })->implode(', ');

                                    DB::table('past_orders')->insert([
                                        'table_number' => $record->table_number,
                                        'session_id' => $record->session_id,
                                        'total_amount' => $originalTotalAmount,
                                        'device_info' => $record->device_info,
                                        'note' => $record->note ?? '-',
                                        'customer' => $record->customer,
                                        'products' => $productDetails,
                                        'quantity' => $orderItems->sum('quantity'),
                                        'payment' => 'Eksiltmeli Ödeme',
                                        'created_at' => $record->created_at,
                                        'updated_at' => now(),
                                    ]);

                                    Notification::make()
                                        ->title('Ödeme Tamamlandı')
                                        ->body('Tüm hesap ödendi.')
                                        ->success()
                                        ->send();

                                    $record->delete();
                                } else {
                                    // Kalan miktarı güncelle
                                    $record->total_amount = $remainingAmount;
                                    $record->save();

                                    Notification::make()
                                        ->title('Ödeme Güncellendi')
                                        ->body("Kalan tutar: {$remainingAmount}₺")
                                        ->success()
                                        ->send();
                                }
                            })
                            ->modalButton('Tutarı Eksilt')
                            ->color('warning')
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
