<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\ProductResource\Pages;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $pluralModelLabel = "Ürün Yönetimi";

    protected static ?string $navigationGroup = 'Kafe ve Menü İçerik Yönetimi';

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('title')
                ->label('Ürün Adı')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('price')
                ->label('Ürün Fiyatı')
                ->numeric()
                ->maxValue(1)
                ->maxValue(20000)
                ->required(),
            Forms\Components\Select::make('category_id')
                ->label('Ürün Kategorisi')
                ->relationship('category', 'name')
                ->required(),
            Forms\Components\FileUpload::make('thumbnail')
                ->label('Ürün Fotoğrafı')
                ->directory('img'),
            Forms\Components\Textarea::make('body')
                ->label('Ürün Açıklaması')
                ->required()
                ->columnSpanFull(),
            Forms\Components\Toggle::make('active')
                ->label('Aktiflik Ayarı')
                ->default('on')
                ->onColor('success')
                ->offColor('danger')
                ->required()
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Fotoğraf')
                    ->defaultImageUrl(url('storage/img/thumbnail.jpg')),
                Tables\Columns\TextColumn::make('title')
                    ->label('Ürün Adı')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                ->label('Aktiflik')
                ->action(function($record, $column) {
                    $name = $column->getName();
                    $record->update([
                        $name => !$record->$name
                    ]);
                })
                    ->boolean(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Fiyat')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                    ->suffix('₺')
                    ->sortable(),
            ])
            ->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
