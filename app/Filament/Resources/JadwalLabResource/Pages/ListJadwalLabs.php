<?php

namespace App\Filament\Resources\JadwalLabResource\Pages;

use App\Filament\Resources\JadwalLabResource;
use Filament\Resources\Pages\Page;
use App\Models\JadwalLab;


class ListJadwalLabs extends Page
{
    protected static string $resource = JadwalLabResource::class;

    protected static string $view = 'filament.resources.jadwal-lab.custom-index';

    protected function getViewData(): array
    {
        $jadwals = JadwalLab::with([
            'laboratorium',
            'user1', 'user2', 'user3', 'user4', 'user5'
        ])->get();

        $hariList = ['senin', 'selasa', 'rabu', 'kamis', 'jumat'];
        $grouped = [];

        foreach ($jadwals as $jadwal) {
            $namaLab = $jadwal->laboratorium->nama_lab ?? 'Tanpa Nama';
            $hari = strtolower($jadwal->hari);

            $grouped[$namaLab]['nama'] = $namaLab;
            $grouped[$namaLab]['jadwal'][$hari][] = [
                'id' => $jadwal->id,
                'jam' => $jadwal->jam_awal . ' - ' . $jadwal->jam_akhir,
                'petugas' => collect([
                    $jadwal->user1,
                    $jadwal->user2,
                    $jadwal->user3,
                    $jadwal->user4,
                    $jadwal->user5,
                ])->filter()->pluck('name')->all(),
            ];
        }

        // pastikan semua hari ada walau kosong
        foreach ($grouped as &$lab) {
            foreach ($hariList as $hari) {
                $lab['jadwal'][$hari] = $lab['jadwal'][$hari] ?? [];
            }
        }

        return [
            'labs' => array_values($grouped),
            'hariList' => $hariList,
        ];
    }

}
