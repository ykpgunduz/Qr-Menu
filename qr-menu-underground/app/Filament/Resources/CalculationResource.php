<?php

namespace App\Filament\Resources;

use DB;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Calculation;
use TextEntry\TextEntrySize;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CalculationResource\Pages;
use App\Filament\Resources\CalculationResource\RelationManagers;

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
                //
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
                    TextColumn::make('total_amount')->label('Toplam Tutar')
                        ->html()
                        ->formatStateUsing(fn ($state) => '<span style="font-size: 20px;">' . number_format($state, 0) . '₺</span>')
                ])->space(3),
                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\Layout\Grid::make(1)
                        ->schema([
                            TextColumn::make('created_at')
                                ->label('İlk Sipariş')
                                ->formatStateUsing(fn ($state) => 'İlk sipariş:<br>' . Carbon::parse($state)->diffForHumans())
                                ->html(), // HTML desteğini etkinleştiriyoruz
                            TextColumn::make('updated_at')
                                ->label('Son Sipariş')
                                ->formatStateUsing(fn ($state) => 'Son sipariş:<br>' . Carbon::parse($state)->diffForHumans())
                                ->html(), // HTML desteğini etkinleştiriyoruz
                        ]),
                ])->collapsible(),
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
                Tables\Actions\Action::make('markAsPaid')
                ->label('Hesap Ödendi')
                ->action(function (Calculation $record) {
                    // Önce verileri past_orders tablosuna taşıyalım
                    foreach ($record->orderItems as $item) {
                        // Ürün adını doğrudan veritabanından çek
                        $productName = DB::table('products')
                            ->where('id', $item->product_id)
                            ->value('title'); // 'title' yerine gerçek sütun adınızı yazın

                        DB::table('past_orders')->insert([
                            'table_number' => $record->table_number,
                            'session_id' => $record->session_id,
                            'total_amount' => $record->total_amount,
                            'device_info' => $record->device_info,
                            'product_name' => $productName,
                            'quantity' => $item->quantity,
                            'price' => $item->price,
                            'created_at' => $record->created_at,
                            'updated_at' => now(),
                        ]);
                    }

                    // Orijinal kaydı güncelle
                    $record->update([
                        'status' => 'paid', // Durumu güncelleyin
                    ]);

                    // İsterseniz orijinal kaydı silebilirsiniz
                    $record->delete();
                })
                ->color('warning'),
            ])
            ->bulkActions([
                //
            ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
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
