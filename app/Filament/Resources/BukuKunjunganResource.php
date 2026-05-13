<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BukuKunjunganResource\Pages;
use App\Filament\Resources\BukuKunjunganResource\RelationManagers;
use App\Models\BukuKunjungan;
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

class BukuKunjunganResource extends Resource
{
    protected static ?string $model = BukuKunjungan::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Forms\Components\TextInput::make('pengunjung')
                        ->label('Nama Pengunjung')
                        ->placeholder('Nama Pengunjung')
                        ->required()
                        ->maxLength(255),
                
                    Select::make('peminjaman_id')
                        ->label('Pemakaian Lab')
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
                        ->helperText('*Kosongkan jika hanya kunjungan, bukan aktivitas pemakaian lab'),

                    Forms\Components\DateTimePicker::make('waktu_masuk')
                        ->label('Waktu Datang')
                        ->required(),

                    Forms\Components\DateTimePicker::make('waktu_keluar')
                        ->label('Waktu Keluar')
                        ->nullable(),

                    Forms\Components\Textarea::make('keperluan')
                        ->label('Keperluan')
                        ->rows(4)
                        ->placeholder('Keperluan')
                        ->nullable(),

                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pengunjung')->label('Pengunjung')->searchable(),
                
                // Tables\Columns\TextColumn::make('peminjaman')
                //     ->label('Penggunaan Lab Terkait')
                //     ->getStateUsing(function ($record) {
                //         return $record->peminjaman && $record->peminjaman->laboratorium
                //             ? 'Lab ' . $record->peminjaman->laboratorium->nama
                //             : '-';
                //     }),
                Tables\Columns\TextColumn::make('penggunaan_lab')
                    ->label('Penggunaan Lab Terkait')
                    ->getStateUsing(fn ($record) => $record->peminjaman && $record->peminjaman->laboratorium
                        ? $record->peminjaman->laboratorium->nama_lab.' ['. $record->peminjaman->nama_peminjam.']'
                        : '')->searchable(),

                Tables\Columns\TextColumn::make('waktu_masuk')->dateTime()->label('Waktu Masuk')->searchable(),
                Tables\Columns\TextColumn::make('waktu_keluar')->dateTime()->label('Waktu Keluar')->searchable(),
                Tables\Columns\TextColumn::make('keperluan')->label('Keperluan')->searchable(),
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
            'index' => Pages\ListBukuKunjungans::route('/'),
            'create' => Pages\CreateBukuKunjungan::route('/create'),
            'edit' => Pages\EditBukuKunjungan::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Aktivitas';
    }

    public static function getNavigationLabel(): string
    {
        return 'Buku Kunjungan';
    }

    public static function getNavigationSort(): ?int
    {
        return 4; // semakin kecil, semakin atas
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['peminjaman.laboratorium']);
    }
}
