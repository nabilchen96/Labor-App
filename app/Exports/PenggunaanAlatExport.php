<?php

namespace App\Exports;

use App\Models\PenggunaanAlat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PenggunaanAlatExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
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
        $query = PenggunaanAlat::with(['peminjaman.laboratorium', 'alat']);

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('waktu_mulai', [$this->startDate, $this->endDate]);
        }

        return $query->get();
    }

    public function map($penggunaan): array
    {
        return [
            $penggunaan->peminjaman->laboratorium->nama_lab ?? '-',
            $penggunaan->alat->nama_alat ?? '-',
            $penggunaan->user_nama ?? '-',
            $penggunaan->waktu_mulai,
            $penggunaan->waktu_selesai,
            $penggunaan->kondisi_awal ?? '-',
            $penggunaan->kondisi_akhir ?? '-',
            $penggunaan->catatan ?? '-',
            $penggunaan->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Laboratorium',
            'Nama Alat',
            'Pengguna',
            'Waktu Mulai',
            'Waktu Selesai',
            'Kondisi Awal',
            'Kondisi Akhir',
            'Catatan',
            'Dibuat Pada',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 30,
            'C' => 25,
            'D' => 25,
            'E' => 25,
            'F' => 35,
            'G' => 35,
            'H' => 40,
            'I' => 40,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // header tebal
        ];
    }
}
