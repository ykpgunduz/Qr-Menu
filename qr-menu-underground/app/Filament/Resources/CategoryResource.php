<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoryResource\RelationManagers;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $pluralModelLabel = "Kategoriler";

    protected static ?string $navigationGroup = 'İçerik Yönetimi'; // Navigasyon grubu

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Kategori Başlığı')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Kategori Başlığı')
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'view' => Pages\ViewCategory::route('/{record}'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
