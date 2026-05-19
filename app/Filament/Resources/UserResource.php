<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Usuarios';
    protected static ?string $modelLabel = 'Usuario';
    protected static ?string $pluralModelLabel = 'Usuarios';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nombre')
                ->required(),
            Forms\Components\TextInput::make('email')
                ->label('Correo')
                ->email()
                ->required(),
            Forms\Components\Select::make('role')
                ->label('Rol')
                ->options([
                    'comprador' => 'Comprador',
                    'vendedor' => 'Vendedor',
                    'admin' => 'Administrador',
                ])
                ->required(),
            Forms\Components\Toggle::make('active')
                ->label('Activo')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable(),
            Tables\Columns\TextColumn::make('email')->label('Correo')->searchable(),
            Tables\Columns\BadgeColumn::make('role')->label('Rol')
                ->colors([
                    'success' => 'vendedor',
                    'warning' => 'comprador',
                    'danger' => 'admin',
                ]),
            Tables\Columns\IconColumn::make('active')->label('Activo')->boolean(),
            Tables\Columns\TextColumn::make('created_at')->label('Registro')->dateTime('d/m/Y'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
