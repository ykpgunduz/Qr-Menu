<?php

namespace App\Filament\Resources;

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

    protected static ?string $navigationGroup = 'Siparişler ve Masalar';

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

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
                Tables\Columns\Layout\Stack::make([
                    TextColumn::make('table_number')
                        ->label('Masa Numarası')
                        ->weight(FontWeight::Bold)
                        ->html()
                        ->formatStateUsing(fn ($state) => '<span style="font-size: 20px; font-weight: bold;">' . $state . '. Masa</span>'),

                    TextColumn::make('total_amount')->label('Toplam Tutar')
                        ->html() // HTML desteğini açıyoruz
                        ->formatStateUsing(fn ($state) => '<span style="font-size: 20px;">' . number_format($state, 0) . '₺</span>'),
                ]),
            ])->space(3),
            Tables\Columns\Layout\Panel::make([
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\ColorColumn::make('')
                        ->grow(false),
                    Tables\Columns\TextColumn::make('order_items.product_id')
                        ->color('gray'),
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
            // Tables\Actions\Action::make('visit')
            //     ->label('Visit link')
            //     ->icon('heroicon-m-arrow-top-right-on-square')
            //     ->color('gray')
            //     ->url(fn (Link $record): string => '#' . urlencode($record->url)),
            // Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            // Tables\Actions\BulkActionGroup::make([
            //     Tables\Actions\DeleteBulkAction::make()
            //         ->action(function () {
            //             Notification::make()
            //                 ->title('Now, now, don\'t be cheeky, leave some records for others to play with!')
            //                 ->warning()
            //                 ->send();
            //         }),
            // ]),
        ]);
}
    //         ->columns([
    //             TextColumn::make('id')->label('ID'),
    //             TextColumn::make('table_number')->label('Masa Numarası'),
    //             TextColumn::make('total_amount')->label('Toplam Tutar')->formatStateUsing(fn ($state) => number_format($state, 2) . '₺'),
    //             TextColumn::make('created_at')->label('Oluşturulma Tarihi')->dateTime('H:i d/m/Y'),
    //         ])
    //         ->filters([
    //             //
    //         ])
    //         ->actions([
    //             Tables\Actions\EditAction::make(),
    //         ])
    //         ->bulkActions([
    //             Tables\Actions\BulkActionGroup::make([
    //                 Tables\Actions\DeleteBulkAction::make(),
    //             ]),
    //         ]);
    // }

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
