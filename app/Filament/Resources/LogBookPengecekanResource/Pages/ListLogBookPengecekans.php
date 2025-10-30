<?php

namespace App\Filament\Resources\LogBookPengecekanResource\Pages;

use App\Filament\Resources\LogBookPengecekanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use App\Exports\LogBookPengecekanExport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;


class ListLogBookPengecekans extends ListRecords
{
    protected static string $resource = LogBookPengecekanResource::class;

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
                $fileName = 'LogBook_' . now()->format('Ymd_His') . '.xlsx';
                return Excel::download(
                    new LogBookPengecekanExport($data['start_date'], $data['end_date']),
                    $fileName
                );
            }),

            // Tombol tambah data
            Actions\CreateAction::make()
                ->label('Tambah')
                ->icon('heroicon-o-plus-circle')
                ->color('warning'),
        ];
    }
}
