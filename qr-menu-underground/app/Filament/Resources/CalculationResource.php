<?php

namespace App\Filament\Resources;

use DB;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Calculation;
use Illuminate\Validation\Rule;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Stack;
use App\Filament\Resources\CalculationResource\Pages;

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
                Action::make('viewDetails')
                ->label('Detay')
                ->icon('heroicon-o-eye')
                ->action(function (Calculation $record, \Filament\Forms\ComponentContainer $form) {
                    $items = $record->orderItems->map(function ($item) {
                        return [
                            'product_id' => $item->product_id, // Product ID direkt olarak gösterilecekse
                            'quantity' => $item->quantity,
                            'price' => $item->price,
                        ];
                    })->toArray();

                    dd($items); // Verileri burada kontrol edin
                    $form->fill([
                        'items' => $items,
                    ]);
                })
                ->form([
                    Forms\Components\Repeater::make('items')
                        ->schema([
                            Forms\Components\Placeholder::make('product_id')
                                ->label('Ürün ID')
                                ->content(fn ($record) => $record['product_id']),
                            Forms\Components\Placeholder::make('quantity')
                                ->label('Miktar')
                                ->content(fn ($record) => $record['quantity']),
                            Forms\Components\Placeholder::make('price')
                                ->label('Fiyat')
                                ->content(fn ($record) => $record['price'] . '₺'),
                        ])
                        ->disableItemMovement()
                        ->disableItemCreation()
                        ->disableItemDeletion()
                        ->columns(3),
                ])
                ->modalHeading('Masa Detayları')
                ->modalButton('Kapat')
                ->color('primary'),

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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('markAsPaid')
                        ->label('Ödendi İşaretle')
                        ->action(function (Calculation $record) {
                            $productDetails = $record->orderItems->map(function ($item) {
                                $productName = DB::table('products')
                                    ->where('id', $item->product_id)
                                    ->value('title');

                                return $item->quantity . ' x ' . $productName . ' = ' . $item->price . '₺';
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
                                'created_at' => $record->created_at,
                                'updated_at' => now(),
                            ]);

                            $record->delete();
                        })
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
