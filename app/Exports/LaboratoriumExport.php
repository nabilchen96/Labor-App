<?php

namespace App\Exports;

use App\Models\Laboratorium;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaboratoriumExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    public function collection()
    {
        return Laboratorium::select('nama_lab', 'kepemilikan', 'keterangan', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['Nama Lab', 'Kepemilikan', 'Keterangan', 'Dibuat Pada'];
    }

    // ✅ Atur lebar kolom di sini
    public function columnWidths(): array
    {
        return [
            'A' => 25, // Nama Lab
            'B' => 20, // Kepemilikan
            'C' => 40, // Keterangan
            'D' => 40, // Dibuat Pada
        ];
    }

    // (Opsional) styling tambahan biar rapi
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // header tebal
        ];
    }
}
