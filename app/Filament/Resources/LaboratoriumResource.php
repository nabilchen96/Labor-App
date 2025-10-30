<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaboratoriumResource\Pages;
use App\Filament\Resources\LaboratoriumResource\RelationManagers;
use App\Models\Laboratorium;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Card;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Filament\Tables\Actions;
use Illuminate\Database\Eloquent\Model;


class LaboratoriumResource extends Resource
{
    protected static ?string $model = Laboratorium::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make([
                TextInput::make('nama_lab')
                    ->required()
                    ->placeholder('Laboratorium'),
                Select::make('kepemilikan')
                    ->label('Kepemilikan')
                    ->options([
                        'TRBU' => 'TRBU',
                        'PPKP' => 'PPKP',
                        'MBU' => 'MBU',
                        'Umum' => 'Umum'
                    ])
                    ->required(),
                FileUpload::make('gambar')
                    ->label('Upload Gambar')
                    ->image() // hanya izinkan gambar
                    ->directory('gambar-laboratorium') // simpan ke folder storage/app/public/gambar-laboratorium
                    ->imagePreviewHeight('150')
                    ->required(false), // bisa dikosongkan
                Textarea::make('keterangan')
                    ->placeholder('Keterangan'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            ImageColumn::make('gambar') // nama kolom di database
                ->label('Gambar')       // label kolom di tabel
                ->disk('public')        // gunakan disk 'public'
                ->height(80)
                ->width(80),
            TextColumn::make('nama_lab')->searchable(),
            TextColumn::make('kepemilikan'),
            TextColumn::make('keterangan')
                ->limit(50)
                ->wrap()
                ->extraAttributes(['style' => 'max-width: 250px;'])
                ->tooltip(fn ($record) => $record->keterangan),
            TextColumn::make('created_at')->dateTime(),
        ])
        
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function tableActions(): array
    {
        return [
            ExportAction::make('exportTable')
                ->label('Export Excel')
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->withFilename('data-laboratorium-' . now()->format('Y-m-d')),
                ]),
        ];
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
            'index' => Pages\ListLaboratoria::route('/'),
            'create' => Pages\CreateLaboratorium::route('/create'),
            'edit' => Pages\EditLaboratorium::route('/{record}/edit'),
        ];
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


    public static function getNavigationGroup(): ?string
    {
        return 'Master';
    }

    public static function getNavigationLabel(): string
    {
        return 'Laboratorium';
    }

    public static function getNavigationSort(): ?int
    {
        return 1; // semakin kecil, semakin atas
    }

}
