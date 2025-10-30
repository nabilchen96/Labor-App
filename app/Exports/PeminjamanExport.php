<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
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
        $query = Peminjaman::with(['laboratorium', 'instruktur']);

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('tanggal_peminjaman', [$this->startDate, $this->endDate]);
        }

        return $query->get();
    }

    public function map($peminjaman): array
    {
        return [
            $peminjaman->nama_peminjam,
            $peminjaman->laboratorium->nama_lab ?? '-',
            $peminjaman->instruktur->nama_instruktur ?? '-',
            $peminjaman->tanggal_peminjaman,
            $peminjaman->tanggal_pengembalian,
            $peminjaman->status,
            $peminjaman->keperluan,
            $peminjaman->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Peminjam',
            'Laboratorium',
            'Instruktur',
            'Tanggal Peminjaman',
            'Tanggal Pengembalian',
            'Status',
            'Keperluan',
            'Dibuat Pada',
        ];
    }

        // ✅ Atur lebar kolom di sini
    public function columnWidths(): array
    {
        return [
            'A' => 30, 
            'B' => 30, 
            'C' => 30, 
            'D' => 30, 
            'E' => 30, 
            'F' => 30, 
            'G' => 30, 
            'H' => 30,
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
