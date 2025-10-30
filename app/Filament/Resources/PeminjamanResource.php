<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeminjamanResource\Pages;
use App\Filament\Resources\PeminjamanResource\RelationManagers;
use App\Models\Peminjaman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\DateColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;

class PeminjamanResource extends Resource
{
    protected static ?string $model = Peminjaman::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make([
                TextInput::make('nama_peminjam')
                    ->placeholder('Nama Peminjam')
                    ->required(),
                Select::make('laboratorium_id')
                    ->label('Laboratorium')
                    ->relationship('laboratorium', 'nama_lab')
                    ->searchable()
                    ->required(),
                DateTimePicker::make('tanggal_peminjaman')->required(),
                DateTimePicker::make('tanggal_pengembalian')->required(),
                Select::make('status')
                    ->options([
                        'Belum Dicek' => 'Belum Dicek',
                        'Disetujui' => 'Disetujui',
                        'Ditolak' => 'Ditolak',
                    ])
                    ->default('Belum Dicek')
                    ->required(),
                Select::make('instruktur_id')
                    ->label('Instruktur')
                    ->relationship('instruktur', 'nama_instruktur')
                    ->searchable()
                    ->required(),
                Textarea::make('keperluan')
                    ->placeholder('Keperluan')
                    ->rows(6)
                    ->required(),
            ])->columns(2)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
                TextColumn::make('nama_peminjam')->searchable(),
                TextColumn::make('laboratorium.nama_lab')->label('Laboratorium'),
                TextColumn::make('tanggal_peminjaman')->dateTime(),
                TextColumn::make('tanggal_pengembalian')->dateTime(),
                BadgeColumn::make('status')->colors([
                    'primary' => 'Belum Dicek',
                    'success' => 'Disetujui',
                    'danger' => 'Ditolak',
                ]),
                TextColumn::make('instruktur.nama_instruktur')->label('Instruktur'),
                TextColumn::make('keperluan')
                    ->limit(50)
                    ->wrap()
                    ->extraAttributes(['style' => 'max-width: 250px;'])
                    ->tooltip(fn ($record) => $record->keperluan),
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
            'index' => Pages\ListPeminjamen::route('/'),
            'create' => Pages\CreatePeminjaman::route('/create'),
            'edit' => Pages\EditPeminjaman::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Aktivitas';
    }

    public static function getNavigationLabel(): string
    {
        return 'Peminjaman';
    }

    public static function getNavigationSort(): ?int
    {
        return 2; // semakin kecil, semakin atas
    }
}
