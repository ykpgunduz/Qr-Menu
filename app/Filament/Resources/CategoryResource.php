<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColorColumn;
use App\Filament\Resources\CategoryResource\Pages;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $pluralModelLabel = "Kategoriler";

    protected static ?string $navigationGroup = 'Kafe ve Menü İçerik Yönetimi';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Kategori Başlığı')
                    ->columnSpan('full'),
                Select::make('icon')
                    ->options([
                        'fa-regular fa-snowflake' => 'Kar İkonu',
                        'fa-solid fa-fire-flame-curved' => 'Alev İkonu',
                        'fa-solid fa-cookie-bite' => 'Kurabiye İkonu',
                        'fa-solid fa-motorcycle' => 'Motor İkonu',
                    ])
                    ->label('İkon Seçiniz')
                    ->required(),
                Select::make('color')
                    ->options([
                        '#005AC8' => 'Mavi',
                        '#B40000' => 'Kırmızı',
                        '#000000' => 'Siyah',
                        '#A35200' => 'Kahverengi',
                    ])
                    ->label('İkon Rengi')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Kategori Başlığı'),
                ColorColumn::make('color')->label('İkon Rengi'),
            ])
            ->paginated(['all'])
            ->actions([Tables\Actions\EditAction::make()]);
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
