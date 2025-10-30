<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalLabResource\Pages;
use App\Filament\Resources\JadwalLabResource\RelationManagers;
use App\Models\JadwalLab;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Card;

class JadwalLabResource extends Resource
{
    protected static ?string $model = JadwalLab::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Select::make('laboratorium_id')
                        ->relationship('laboratorium', 'nama_lab')
                        ->required()
                        ->searchable()
                        ->label('Laboratorium'),

                    Select::make('id_user_1')->relationship('user1', 'name')->label('User 1')->searchable()->nullable(),
                    Select::make('id_user_2')->relationship('user2', 'name')->label('User 2')->searchable()->nullable(),
                    Select::make('id_user_3')->relationship('user3', 'name')->label('User 3')->searchable()->nullable(),
                    Select::make('id_user_4')->relationship('user4', 'name')->label('User 4')->searchable()->nullable(),
                    Select::make('id_user_5')->relationship('user5', 'name')->label('User 5')->searchable()->nullable(),

                    Select::make('hari')
                        ->options([
                            'Senin' => 'Senin',
                            'Selasa' => 'Selasa',
                            'Rabu' => 'Rabu',
                            'Kamis' => 'Kamis',
                            'Jumat' => 'Jumat',
                            'Sabtu' => 'Sabtu',
                            'Minggu' => 'Minggu',
                        ])
                        ->required(),

                    TimePicker::make('jam_awal')->required(),
                    TimePicker::make('jam_akhir')->required(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('laboratorium.nama_lab')->label('Laboratorium'),
                TextColumn::make('hari'),
                TextColumn::make('jam_awal')->time(),
                TextColumn::make('jam_akhir')->time(),
                TextColumn::make('user1.name')->label('User 1'),
                TextColumn::make('user2.name')->label('User 2'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListJadwalLabs::route('/'),
            'create' => Pages\CreateJadwalLab::route('/create'),
            'edit' => Pages\EditJadwalLab::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Aktivitas';
    }

    public static function getNavigationLabel(): string
    {
        return 'Jadwal Jaga';
    }

    public static function getNavigationSort(): ?int
    {
        return 1; // semakin kecil, semakin atas
    }

}
