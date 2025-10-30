<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlatLaboratoriumResource\Pages;
use App\Filament\Resources\AlatLaboratoriumResource\RelationManagers;
use App\Models\AlatLaboratorium;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Model;

class AlatLaboratoriumResource extends Resource
{
    protected static ?string $model = AlatLaboratorium::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Select::make('laboratorium_id')
                        ->relationship('laboratorium', 'nama_lab')
                        ->required()
                        ->label('Laboratorium')
                        ->searchable(),
                    TextInput::make('nama_alat')
                        ->placeholder('Alat')
                        ->required(),
                    FileUpload::make('gambar')
                        ->directory('gambar-alat'),
                    Select::make('tipe')
                        ->label('Tipe')
                        ->options([
                            'Alat' => 'Alat', 
                            'Simulator' => 'Simulator', 
                            'Perangkat Komputer' => 'Perangkat Komputer', 
                            'Lainnya' => 'Lainnya'
                        ])
                    ->required(),
                    Textarea::make('keterangan')
                        ->placeholder('Keterangan'),
                ])->columns(2)  
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')
                    ->height(80)
                    ->width(80)
                    ->disk('public'),
                TextColumn::make('laboratorium.nama_lab')->label('Laboratorium'),
                TextColumn::make('nama_alat')->searchable(),
                TextColumn::make('tipe'),
                TextColumn::make('keterangan')
                    ->limit(50)
                    ->wrap()
                    ->extraAttributes(['style' => 'max-width: 250px;'])
                    ->tooltip(fn ($record) => $record->keterangan),
                TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListAlatLaboratoria::route('/'),
            'create' => Pages\CreateAlatLaboratorium::route('/create'),
            'edit' => Pages\EditAlatLaboratorium::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Master';
    }

    public static function getNavigationLabel(): string
    {
        return 'Alat Laboratorium';
    }

    public static function getNavigationSort(): ?int
    {
        return 2; // semakin kecil, semakin atas
    }

    //HANYA ROLE ADMIN YANG BISA MENAMBAH DATA
    public static function canCreate(): bool
    {
        return auth()->user()?->role === 'Admin';
    }

    //HANYA ROLE ADMIN YANG BISA MENGEDIT DATA
    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->role === 'Admin';
    }

    //HANYA ROLE ADMIN YANG BISA MENGHAPUS DATA
    public static function canDeleteAny(): bool
    {
        return auth()->user()?->role === 'Admin';
    }
}
