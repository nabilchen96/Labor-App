<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Peminjaman;

class TabelPeminjamanDisetujui extends BaseWidget
{
    protected static ?string $heading = '';

    // 🎨 Tambahkan tinggi + scroll
    protected function getTableContentGrid(): ?array
    {
        return [
            'md' => 1,
            'xl' => 1,
            'attributes' => [
                'style' => 'max-height: 400px; overflow-y: auto;',
            ],
        ];
    }

    protected function getTableQuery(): Builder
    {
        return Peminjaman::query()
            ->with(['laboratorium'])
            ->where('status', 'Disetujui')
            ->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('nama_peminjam')->label('Nama Peminjam'),
            Tables\Columns\TextColumn::make('laboratorium.nama_lab')->label('Laboratorium'),
            Tables\Columns\TextColumn::make('tanggal_peminjaman')->dateTime()->label('Tgl Peminjaman'),
            Tables\Columns\TextColumn::make('status')->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Belum Dicek' => 'warning',
                    'Disetujui' => 'success',
                    'Ditolak' => 'danger',
                    default => 'gray',
                }),
        ];
    }
}
