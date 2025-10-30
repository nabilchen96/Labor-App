<?php

namespace App\Exports;

use App\Models\Instruktur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InstrukturExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    public function collection()
    {
        return Instruktur::select('nama_instruktur', 'email', 'nomor_telepon', 'keahlian', 'created_at')->get();
    }

    public function map($instruktur): array
    {
        // Jika keahlian berupa JSON / array, ubah menjadi string rapi
        $keahlian = $instruktur->keahlian;

        if (is_array($keahlian)) {
            $keahlian = implode(', ', $keahlian);
        } elseif (is_string($keahlian) && $this->isJson($keahlian)) {
            $keahlian = implode(', ', json_decode($keahlian, true));
        }

        return [
            $instruktur->nama_instruktur,
            $instruktur->email,
            $instruktur->nomor_telepon,
            $keahlian,
            $instruktur->created_at->format('Y-m-d H:i:s'),
        ];
    }

    // Deteksi apakah string berupa JSON
    private function isJson($string): bool
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function headings(): array
    {
        return [
            'Nama Instruktur',
            'Email',
            'Nomor Telepon',
            'Keahlian',
            'Dibuat Pada',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 30,
            'C' => 20,
            'D' => 50,
            'E' => 40,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
