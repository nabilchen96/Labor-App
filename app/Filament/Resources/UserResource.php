<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Card;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name')
                        ->required()
                        ->placeholder('Nama Lengkap')
                        ->maxLength(255),
                    TextInput::make('email')
                        ->required()
                        ->email()
                        ->placeholder('Email')
                        ->maxLength(255),
                    TextInput::make('password')
                        ->password()
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Password')
                        ->dehydrated(fn ($state) => filled($state))
                        ->dehydrateStateUsing(fn ($state) => bcrypt($state)),
                    Select::make('role')
                        ->label('Role')
                        ->options([
                            'Admin' => 'Admin',
                            'Umum' => 'Umum',
                        ])
                        ->required()
                        ->default('Umum')
                        ->visible(fn () => auth()->user()?->role === 'Admin'), // hanya admin yang bisa edit
                ])->columns(2),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('name')->searchable(),
            TextColumn::make('email')->searchable(),
            TextColumn::make('role')->searchable(),
            TextColumn::make('created_at')->dateTime(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    //HANYA DATA USER YANG BERSANGKUTAN YANG MUNCUL
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()?->role !== 'Admin') {
            $query->where('id', auth()->id()); // user umum hanya lihat dirinya sendiri
        }

        return $query;
    }

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()?->role === 'Admin';
    // }

    // public static function shouldRegisterNavigation(): bool
    // {
    //     return auth()->user()?->role == 'Admin';
    // }

    public static function canCreate(): bool
    {
        return auth()->user()?->role === 'Admin';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Master';
    }

    public static function getNavigationSort(): ?int
    {
        return 0; // semakin kecil, semakin atas
    }
}
