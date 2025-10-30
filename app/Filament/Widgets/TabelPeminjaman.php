<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Peminjaman;

class TabelPeminjaman extends BaseWidget
{

    protected static ?string $heading = 'Data Peminjaman Belum Dicek';

    protected function getTableQuery(): Builder
    {
        return Peminjaman::query()
            ->with(['laboratorium'])
            ->where('status', 'Belum Dicek')
            ->latest()
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('nama_peminjam')->label('Nama Peminjam'),
            Tables\Columns\TextColumn::make('laboratorium.nama_lab')->label('Laboratorium'),
            Tables\Columns\TextColumn::make('tanggal_peminjaman')->dateTime()->label('Tgl Peminjaman'),
            Tables\Columns\TextColumn::make('status')->badge(),
        ];
    }
}
