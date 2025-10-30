<?php

namespace App\Exports;

use App\Models\LogBookPengecekan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LogBookPengecekanExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = LogBookPengecekan::with(['laboratorium', 'alatLaboratorium', 'user']);

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('waktu_pengecekan', [$this->startDate, $this->endDate]);
        }

        return $query->get();
    }

    public function map($log): array
    {
        return [
            $log->laboratorium->nama_lab ?? '-',
            $log->alatLaboratorium->nama_alat ?? '-',
            $log->waktu_pengecekan,
            $log->kondisi,
            $log->keterangan ?? '-',
            $log->user->name ?? '-',
            $log->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Laboratorium',
            'Nama Alat',
            'Waktu Pengecekan',
            'Kondisi',
            'Keterangan',
            'Petugas Pengecekan',
            'Dibuat Pada',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 30,
            'C' => 25,
            'D' => 20,
            'E' => 40,
            'F' => 25,
            'G' => 25,
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
