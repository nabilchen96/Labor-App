<?php

namespace App\Exports;

use App\Models\AlatLaboratorium;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AlatLaboratoriumExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    /**
     * Ambil data alat laboratorium beserta relasi laboratorium.
     */
    public function collection()
    {
        return AlatLaboratorium::with('laboratorium')
            ->select('laboratorium_id', 'nama_alat', 'tipe', 'keterangan', 'created_at')
            ->get();
    }

    /**
     * Tentukan urutan dan isi kolom export.
     */
    public function map($alat): array
    {
        return [
            optional($alat->laboratorium)->nama_lab ?? '-', // Nama Lab
            $alat->nama_alat,
            $alat->tipe,
            $alat->keterangan,
            $alat->created_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Heading kolom (baris pertama Excel)
     */
    public function headings(): array
    {
        return [
            'Nama Laboratorium',
            'Nama Alat',
            'Tipe',
            'Keterangan',
            'Dibuat Pada',
        ];
    }

    /**
     * Atur lebar kolom
     */
    public function columnWidths(): array
    {
        return [
            'A' => 25, // Nama Laboratorium
            'B' => 25, // Nama Alat
            'C' => 20, // Tipe
            'D' => 40, // Keterangan
            'E' => 40, // Dibuat Pada
        ];
    }

    /**
     * Styling dasar (header tebal)
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // header tebal
        ];
    }
}
