<?php

namespace App\Filament\Resources\AlatLaboratoriumResource\Pages;

use App\Filament\Resources\AlatLaboratoriumResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use App\Exports\AlatLaboratoriumExport;

class ListAlatLaboratoria extends ListRecords
{
    protected static string $resource = AlatLaboratoriumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tombol Export Excel
            Actions\Action::make('export_excel')
                ->label('Export')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    // Jalankan export langsung
                    return Excel::download(new AlatLaboratoriumExport, 'data-laboratorium-' . now()->format('Y-m-d') . '.xlsx');
                }),

            // Tombol tambah data
            Actions\CreateAction::make()
                ->label('Tambah')
                ->icon('heroicon-o-plus-circle')
                ->color('warning'),
        ];
    }
}
