<?php

namespace App\Exports;

use App\Models\BukuKunjungan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BukuKunjunganExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
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
        $query = BukuKunjungan::with(['peminjaman.laboratorium']);

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('waktu_masuk', [$this->startDate, $this->endDate]);
        }

        return $query->get();
    }

    public function map($kunjungan): array
    {
        return [
            $kunjungan->pengunjung ?? '-',
            $kunjungan->peminjaman?->laboratorium?->nama_lab ?? '-',
            ucfirst($kunjungan->jenis),
            $kunjungan->waktu_masuk,
            $kunjungan->waktu_keluar ?? '-',
            $kunjungan->keperluan ?? '-',
            $kunjungan->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Pengunjung',
            'Laboratorium',
            'Jenis',
            'Waktu Masuk',
            'Waktu Keluar',
            'Keperluan',
            'Dibuat Pada',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 25,
            'C' => 15,
            'D' => 25,
            'E' => 25,
            'F' => 40,
            'G' => 40,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Header tebal
        ];
    }
}
