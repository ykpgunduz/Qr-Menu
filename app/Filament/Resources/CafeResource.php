<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Cafe;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\CafeResource\Pages;

class CafeResource extends Resource
{
    protected static ?string $model = Cafe::class;

    protected static ?string $navigationGroup = 'Kafe ve Menü İçerik Yönetimi';

    protected static ?string $pluralModelLabel = "Kafe Yönetimi";

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Kafenin Adı')
                    ->prefixIcon('heroicon-o-building-storefront')
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('Telefon Numarası')
                    ->prefixIcon('heroicon-o-phone')
                    ->required(),
                Forms\Components\TextInput::make('opening_time')
                    ->label('Kafenin Açılış Saati')
                    ->prefixIcon('heroicon-o-clock')
                    ->required(),
                Forms\Components\TextInput::make('closing_time')
                    ->label('Kafenin Kapanış Saati')
                    ->prefixIcon('heroicon-o-clock')
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->label('Kafenin Açık Adresi')
                    ->prefixIcon('heroicon-o-map-pin')
                    ->required(),
                Forms\Components\TextInput::make('address_link')
                    ->label('Adres Linki (Google Maps)')
                    ->prefixIcon('heroicon-o-link')
                    ->url(),
                Forms\Components\TextInput::make('insta_name')
                    ->label('Instagram Adı')
                    ->prefixIcon('heroicon-o-globe-alt'),
                Forms\Components\TextInput::make('insta_link')
                    ->label('Instagram Linki')
                    ->prefixIcon('heroicon-o-link')
                    ->url(),
                Forms\Components\TextInput::make('description')
                    ->label('Kafenin Sloganı')
                    ->prefixIcon('heroicon-o-sparkles')
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Kafe Adı')
                    ->size('lg')
                    ->weight('bold')
                    ->searchable(false),
                Tables\Columns\TextColumn::make('address')
                    ->label('Adres'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefon')
            ])
            ->actions([
                Tables\Actions\EditAction::make()
            ])
            ->paginated(false)
            ->contentGrid([
                'md' => 1,
            ])
            ->striped(false)
            ->defaultSort('name', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCafes::route('/'),
            'edit' => Pages\EditCafe::route('/{record}/edit'),
        ];
    }
}
