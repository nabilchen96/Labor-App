<?php

namespace App\Filament\Resources\BukuKunjunganResource\Pages;

use App\Filament\Resources\BukuKunjunganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use App\Exports\BukuKunjunganExport;
use Maatwebsite\Excel\Facades\Excel;

class ListBukuKunjungans extends ListRecords
{
    protected static string $resource = BukuKunjunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export')
                ->label('Export')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->form([
                    DatePicker::make('start_date')
                        ->label('Tanggal Mulai')
                        ->required(),
                    DatePicker::make('end_date')
                        ->label('Tanggal Akhir')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $fileName = 'Buku_Kunjungan_' . now()->format('Ymd_His') . '.xlsx';
                    return Excel::download(
                        new BukuKunjunganExport($data['start_date'], $data['end_date']),
                        $fileName
                    );
                }),

            Actions\CreateAction::make()
                ->label('Tambah')
                ->icon('heroicon-o-plus-circle')
                ->color('warning'),
        ];
    }
}
