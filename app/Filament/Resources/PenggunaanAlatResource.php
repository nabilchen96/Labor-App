<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenggunaanAlatResource\Pages;
use App\Filament\Resources\PenggunaanAlatResource\RelationManagers;
use App\Models\PenggunaanAlat;
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

class PenggunaanAlatResource extends Resource
{
    protected static ?string $model = PenggunaanAlat::class;

    protected static ?string $navigationIcon = 'heroicon-m-cog';

    // protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form->schema([
             Card::make([
                Select::make('peminjaman_id')
                    ->label('Peminjaman')
                    ->relationship(
                        name: 'peminjaman',
                        titleAttribute: 'nama_peminjam',
                        modifyQueryUsing: fn ($query) => $query->with('laboratorium')
                    )
                    ->getOptionLabelFromRecordUsing(fn ($record) => 
                        $record->nama_peminjam . 
                        ' [' . ($record->laboratorium->nama_lab ?? '-') . ']' .
                        ' [' . $record->tanggal_peminjaman . ']'
                    )
                    ->searchable()
                    ->required(),

                TextInput::make('user_nama')
                    ->label('Nama Pengguna')
                    ->placeholder('Nama Pengguna')
                    ->required(),

                Select::make('alat_id')
                    ->relationship('alat', 'nama_alat')
                    ->label('Alat')
                    ->searchable()
                    ->required(),

                DateTimePicker::make('waktu_mulai')
                    ->required(),

                DateTimePicker::make('waktu_selesai')
                    ->required(),

                Select::make('kondisi_awal')
                    ->label('Kondisi')
                    ->options([
                        'Baik' => 'Baik',
                        'Rusak Berat' => 'Rusak Berat',
                        'Rusak Ringan' => 'Rusak Ringan',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->required(),

                Textarea::make('catatan')
                    ->rows(4)
                    ->placeholder('Catatan')

            ])->columns(2)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('user_nama')->label('Nama Pengguna'),
            
            TextColumn::make('alat')
                ->label('Alat [Laboratorium]')
                ->formatStateUsing(function ($record) {
                    $alat = $record->alat->nama_alat ?? '-';
                    $lab = $record->alat->laboratorium->nama_lab ?? '-';
                    return "{$alat} [{$lab}]";
                })->searchable(),

            TextColumn::make('waktu_mulai')
                ->label('Mulai')->searchable(),

            TextColumn::make('waktu_selesai')
                ->label('Selesai')->searchable(),

            BadgeColumn::make('kondisi_awal')
                ->label('Kondisi')
                ->colors([
                    'success' => 'Baik',
                    'warning' => 'Rusak Ringan',
                    'danger' => 'Rusak Berat',
                    'warning' => 'Lainnya',
                ])->searchable(),
        ])
        ->filters([

        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenggunaanAlats::route('/'),
            'create' => Pages\CreatePenggunaanAlat::route('/create'),
            'edit' => Pages\EditPenggunaanAlat::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Aktivitas';
    }

    public static function getNavigationLabel(): string
    {
        return 'Pemakaian Alat';
    }

    public static function getNavigationSort(): ?int
    {
        return 3; // semakin kecil, semakin atas
    }
}
