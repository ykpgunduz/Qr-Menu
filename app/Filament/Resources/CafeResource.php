<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CafeResource\Pages;
use App\Models\Cafe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                    ->label('Kafe Adı')
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('Telefon')
                    ->required(),
                Forms\Components\TextInput::make('opening_time')
                    ->label('Açılış Saati')
                    ->required(),
                Forms\Components\TextInput::make('closing_time')
                    ->label('Kapanış Saati')
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->label('Adres')
                    ->required(),
                Forms\Components\TextInput::make('address_link')
                    ->label('Adres Linki')
                    ->required()
                    ->url(),
                Forms\Components\Textarea::make('description')
                    ->label('Açıklama')
                    ->rows(3),
                Forms\Components\TextInput::make('instagram')
                    ->label('Instagram Linki')
                    ->url(),
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
