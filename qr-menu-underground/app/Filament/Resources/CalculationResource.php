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
                ])->space(3)
                ->extraAttributes(fn ($record) => [
                    'style' => match ($record->status) {
                        'Hesap' => 'box-shadow: 0px 0px 10px 5px rgba(255, 193, 7, 0.7); outline-offset: 10px; padding: 15px;',  // Sarı dış çizgi
                        'Aktif' => 'box-shadow: 0px 0px 10px 5px rgba(0, 255, 0, 0.7); outline-offset: 10px; padding: 15px;',   // Yeşil dış çizgi
                    },
                ]),
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
                Tables\Actions\Action::make('markAsPaid')
                ->label('Ödendi İşaretle')
                ->action(function (Calculation $record) {
                    foreach ($record->orderItems as $item) {
                        $productName = DB::table('products')
                            ->where('id', $item->product_id)
                            ->value('title');

                        DB::table('past_orders')->insert([
                            'table_number' => $record->table_number,
                            'session_id' => $record->session_id,
                            'total_amount' => $record->total_amount,
                            'device_info' => $record->device_info,
                            'note' => $record->note,
                            'product_name' => $productName,
                            'quantity' => $item->quantity,
                            'price' => $item->price,
                            'created_at' => $record->created_at,
                            'updated_at' => now(),
                        ]);
                    }

                    $record->delete();
                })
                ->color('warning')
                ->visible(fn (Calculation $record) => $record->status === 'Hesap'),
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
