<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $pluralModelLabel = "Ürünler";

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
                    ->label('Ürün Fotoğrafı')
                    ->defaultImageUrl(url('storage/img/thumbnail.jpg')),
                Tables\Columns\TextColumn::make('title')
                    ->label('Ürün Adı')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->label('Aktiflik')
                    ->boolean(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Ürün Fiyatı')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                    ->suffix('₺')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
