<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $pluralModelLabel = "Kullanıcılar";

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
                ->label('Ad Soyad')
                ->required()
                ->maxLength(50)
                ->reactive(),
            TextInput::make('email')
                ->label('E-posta')
                ->email()
                ->required()
                ->maxLength(50)
                ->reactive(),
            TextInput::make('password')
                ->label('Şifre')
                ->password()
                ->required()
                ->maxLength(50)
                ->reactive(),
            Select::make('roles')
                ->label('Kullanıcı Rolü')
                ->relationship('roles', 'name')
                ->required()
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('İsim'),
                TextColumn::make('email')
                    ->label('E-Posta'),
                TextColumn::make('roles')
                    ->label('Roller')
                    ->getStateUsing(fn ($record) => $record->roles->pluck('name')->join(', ')),

            ])
            ->paginated(['all'])
            ->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
