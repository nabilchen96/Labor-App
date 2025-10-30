<?php

namespace App\Filament\Resources\LaboratoriumResource\Pages;

use App\Filament\Resources\LaboratoriumResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use App\Exports\LaboratoriumExport;

class ListLaboratoria extends ListRecords
{
    protected static string $resource = LaboratoriumResource::class;

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
                    return Excel::download(new LaboratoriumExport, 'data-laboratorium-' . now()->format('Y-m-d') . '.xlsx');
                }),

            // Tombol tambah data
            Actions\CreateAction::make()
                ->label('Tambah')
                ->icon('heroicon-o-plus-circle')
                ->color('warning'),
        ];
    }
}
