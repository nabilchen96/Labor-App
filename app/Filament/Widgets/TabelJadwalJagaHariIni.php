<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\JadwalLab;
use Carbon\Carbon;

class TabelJadwalJagaHariIni extends BaseWidget
{
    protected static ?string $heading = '';

    protected function getTableQuery(): Builder
    {
        // Ambil hari sekarang dalam bahasa Indonesia (misalnya: Senin, Selasa, dst)
        $hariIni = Carbon::now()->locale('id')->dayName;

        return JadwalLab::query()
            ->where('hari', ucfirst($hariIni))
            ->with(['laboratorium', 'user1', 'user2', 'user3', 'user4', 'user5']);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('laboratorium.nama_lab')->label('Laboratorium'),
            Tables\Columns\TextColumn::make('user1.name')->label('Petugas 1')->default('-'),
            Tables\Columns\TextColumn::make('user2.name')->label('Petugas 2')->default('-'),
            Tables\Columns\TextColumn::make('user3.name')->label('Petugas 3')->default('-'),
            Tables\Columns\TextColumn::make('user4.name')->label('Petugas 4')->default('-'),
            Tables\Columns\TextColumn::make('user5.name')->label('Petugas 5')->default('-'),
            Tables\Columns\TextColumn::make('jam_awal')->label('Jam Awal'),
            Tables\Columns\TextColumn::make('jam_akhir')->label('Jam Akhir'),
        ];
    }
}
