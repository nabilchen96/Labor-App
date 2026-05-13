<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogBookPengecekanResource\Pages;
use App\Filament\Resources\LogBookPengecekanResource\RelationManagers;
use App\Models\LogBookPengecekan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BadgeColumn;

class LogBookPengecekanResource extends Resource
{
    protected static ?string $model = LogBookPengecekan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make([
            Select::make('laboratorium_id')
                ->label('Laboratorium')
                ->relationship('laboratorium', 'nama_lab')
                ->required(),

            Select::make('alat_laboratorium_id')
                ->label('Alat')
                ->relationship('alat_laboratorium', 'nama_alat')
                ->required(),

            DateTimePicker::make('waktu_pengecekan')
                ->label('Waktu Pengecekan')
                ->required(),

            Select::make('kondisi')
                ->options([
                    'Baik' => 'Baik',
                    'Rusak Berat' => 'Rusak Berat',
                    'Rusak Ringan' => 'Rusak Ringan',
                    'Lainnya' => 'Lainnya',
                ])
                ->required(),

            Textarea::make('keterangan')
                ->label('Keterangan')
                ->rows(4),

            Select::make('user_id')
                ->label('User')
                ->relationship('user', 'name')
                ->required(),

            FileUpload::make('gambar_pengecekan')
                ->label('Gambar Pengecekan')
                ->image()
                ->directory('pengecekan')
                ->maxSize(2048),
            ])->columns(2)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar_pengecekan') // nama kolom di database
                    ->label('Gambar')       // label kolom di tabel
                    ->disk('public')        // gunakan disk 'public'
                    ->height(80)
                    ->width(80)->searchable(),
                TextColumn::make('laboratorium.nama_lab')->label('Laboratorium'),
                TextColumn::make('alat_laboratorium.nama_alat')->label('Alat'),
                BadgeColumn::make('kondisi')->colors([
                    'success' => 'Baik',
                    'danger' => 'Rusak Berat',
                    'warning' => 'Rusak Ringan',
                    'primary' => 'Lainnya',
                ])->searchable(),
                TextColumn::make('user.name')->label('User')->searchable(),
                TextColumn::make('waktu_pengecekan')->dateTime()->searchable(),
                TextColumn::make('keterangan')
                    ->limit(50)
                    ->wrap()
                    ->extraAttributes(['style' => 'max-width: 180px;'])
                    ->tooltip(fn ($record) => $record->keterangan)->searchable(),
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
            'index' => Pages\ListLogBookPengecekans::route('/'),
            'create' => Pages\CreateLogBookPengecekan::route('/create'),
            'edit' => Pages\EditLogBookPengecekan::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Aktivitas';
    }

    public static function getNavigationLabel(): string
    {
        return 'Log Pengecekan';
    }

    public static function getNavigationSort(): ?int
    {
        return 3; // semakin kecil, semakin atas
    }
}
