<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Models\PenggunaanAlat;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;

class StatistikPenggunaanAlat extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.pages.statistik-penggunaan-alat';

    protected static ?string $navigationLabel = 'Rata-rata Penggunaan Alat';
    protected static ?string $title = 'Rata-rata Penggunaan Alat';
    protected static ?string $navigationGroup = 'Statistik';
    protected static ?int $navigationSort = 2;

    protected static bool $shouldRegisterNavigation = false;

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                TextColumn::make('nama_alat')
                    ->label('Nama Alat')
                    ->searchable()
                    ->weight('bold'),
                
                TextColumn::make('nama_lab')
                    ->label('Laboratorium')
                    ->searchable(),
                
                TextColumn::make('jumlah_penggunaan')
                    ->label('Jumlah Penggunaan')
                    ->numeric()
                    ->alignCenter()
                    ->color('primary'),
                
                TextColumn::make('total_waktu_menit')
                    ->label('Total Waktu')
                    ->alignCenter()
                    ->formatStateUsing(function ($state) {
                        return $this->formatDuration($state);
                    }),
                
                TextColumn::make('rata_waktu_menit')
                    ->label('Rata-rata Waktu')
                    ->color('success')
                    ->alignCenter()
                    ->formatStateUsing(function ($state) {
                        return $this->formatDuration($state);
                    })
            ])
            ->filters([
            Filter::make('tanggal')
                ->form([
                    DatePicker::make('from')->label('Dari Tanggal'),
                    DatePicker::make('until')->label('Sampai Tanggal'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['from'],
                            fn ($q, $date) => $q->whereDate('penggunaan_alats.waktu_mulai', '>=', $date),
                        )
                        ->when(
                            $data['until'],
                            fn ($q, $date) => $q->whereDate('penggunaan_alats.waktu_selesai', '<=', $date),
                        );
                }),
        ])
        ->defaultSort('jumlah_penggunaan', 'desc');
    }

    protected function getTableQuery(): Builder
    {
        $waktuTersediaMenit = 22 * 8 * 60; // 10.560 menit per bulan
        
        return PenggunaanAlat::query()
            ->selectRaw('
                alat_laboratoria.nama_alat,
                laboratoria.nama_lab,
                COUNT(penggunaan_alats.id) as jumlah_penggunaan,
                SUM(
                    CASE 
                        WHEN TIMESTAMPDIFF(MINUTE, penggunaan_alats.waktu_mulai, penggunaan_alats.waktu_selesai) > 1440 THEN 0
                        ELSE TIMESTAMPDIFF(MINUTE, penggunaan_alats.waktu_mulai, penggunaan_alats.waktu_selesai)
                    END
                ) as total_waktu_menit,

                AVG(
                    CASE 
                        WHEN TIMESTAMPDIFF(MINUTE, penggunaan_alats.waktu_mulai, penggunaan_alats.waktu_selesai) > 1440 THEN NULL
                        ELSE TIMESTAMPDIFF(MINUTE, penggunaan_alats.waktu_mulai, penggunaan_alats.waktu_selesai)
                    END
                ) as rata_waktu_menit,

                ROUND((SUM(
                    CASE 
                        WHEN TIMESTAMPDIFF(MINUTE, penggunaan_alats.waktu_mulai, penggunaan_alats.waktu_selesai) > 1440 THEN 0
                        ELSE TIMESTAMPDIFF(MINUTE, penggunaan_alats.waktu_mulai, penggunaan_alats.waktu_selesai)
                    END
                ) / ?) * 100, 1) as presentase_utilization
            ', [$waktuTersediaMenit])
            ->join('alat_laboratoria', 'alat_laboratoria.id', '=', 'penggunaan_alats.alat_id')
            ->join('laboratoria', 'laboratoria.id', '=', 'alat_laboratoria.laboratorium_id')
            ->groupBy('alat_laboratoria.nama_alat', 'laboratoria.nama_lab')
            ->orderBy('total_waktu_menit', 'desc');
    }

    /**
     * Format durasi ke format yang lebih singkat
     */
    protected function formatDuration($totalMenit): string
    {
        if (!$totalMenit) return '0 menit';
        
        $menit = floor($totalMenit);
        $detik = round(($totalMenit - $menit) * 60);
        
        if ($detik > 0) {
            return "{$menit} menit {$detik} detik";
        }
        
        return "{$menit} menit";
    }

    public function getTableRecordKey($record): string
    {
        return md5(($record->nama_alat ?? '') . '_' . ($record->nama_lab ?? ''));
    }
}