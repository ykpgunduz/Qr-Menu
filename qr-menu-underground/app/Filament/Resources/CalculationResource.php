<?php

namespace App\Filament\Resources;

use DB;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Calculation;
use Illuminate\Validation\Rule;
use Filament\Tables\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Stack;
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
                            ->ignore(request()->route('record')), // Kayıt düzenleniyorsa mevcut kaydı yok sayar
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
                Tables\Actions\Action::make('editTableNumber')
                    ->label('Masa Numarasını Düzenle')
                    ->icon('heroicon-o-pencil')
                    ->form([
                        TextInput::make('table_number')
                            ->label('Masa Numarası')
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

                        DB::transaction(function () use ($oldTableNumber, $newTableNumber, $record) {
                            // İlk olarak calculations tablosunu güncelle
                            $record->update([
                                'table_number' => $newTableNumber,
                            ]);

                            // Daha sonra order_items tablosundaki ilgili kayıtları güncelle
                            OrderItem::where('table_number', $oldTableNumber)
                                ->update(['table_number' => $newTableNumber]);
                        });
                    }),

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
                        ->label('Ödendi mi?')
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

                            DB::table('past_orders')->insert([
                                'table_number' => $record->table_number,
                                'session_id' => $record->session_id,
                                'total_amount' => $record->total_amount,
                                'device_info' => $record->device_info,
                                'note' => $record->note ?? '-',
                                'customer' => $record->customer,
                                'products' => $productDetails,
                                'quantity' => $record->orderItems->sum('quantity'),
                                'payment' => $data['payment_method'],
                                'created_at' => $record->created_at,
                                'updated_at' => now(),
                            ]);

                            $record->delete();
                        })
                        ->color('warning')
                        ->visible(fn ($record) => $record->total_amount > 0)
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
