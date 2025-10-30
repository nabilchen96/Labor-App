<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenggunaanAlat;
use Illuminate\Support\Facades\DB;

class StatistikPenggunaanAlatController extends Controller
{
    public function penggunaanAlat(Request $request)
    {
        $query = DB::table('penggunaan_alats')
            ->join('peminjamen', 'peminjamen.id', '=', 'penggunaan_alats.peminjaman_id')
            ->join('alat_laboratoria', 'alat_laboratoria.id', '=', 'penggunaan_alats.alat_id')
            ->select(
                'alat_laboratoria.nama_alat as nama_alat', 
                \DB::raw('COUNT(penggunaan_alats.alat_id) as total')
            );

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('penggunaan_alats.waktu_mulai', [$request->from, $request->to]);
        }

        $query->groupBy('alat_laboratoria.id');

        $data = $query->get();

        return response()->json([
            'labels' => $data->pluck('nama_alat'),
            'series' => $data->pluck('total'),
        ]);
    }

    public function kondisiAlat(Request $request)
    {
        $query = \DB::table('penggunaan_alats')
            ->select('kondisi_awal', \DB::raw('COUNT(*) as total'));

        // filter berdasarkan tanggal peminjaman (join dengan tabel peminjaman jika perlu)
        if ($request->filled('from') && $request->filled('to')) {
            $query->join('peminjamen', 'penggunaan_alats.id_peminjaman', '=', 'peminjamen.id')
                ->whereBetween('peminjamen.tanggal_peminjaman', [$request->from, $request->to]);
        }

        $query->groupBy('kondisi_awal');
        $data = $query->get();

        return response()->json([
            'labels' => $data->pluck('kondisi_awal')->map(fn ($val) => $val ?? 'Tidak diketahui'),
            'series' => $data->pluck('total'),
        ]);
    }


    public function rataAlat(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');

        $query = DB::table('penggunaan_alats as p')
            ->join('alat_laboratoria as a', 'p.alat_id', '=', 'a.id')
            ->join('laboratoria as l', 'a.laboratorium_id', '=', 'l.id')
            ->select(
                'a.nama_alat',
                'l.nama_lab',
                DB::raw('ROUND(AVG(TIMESTAMPDIFF(MINUTE, p.waktu_mulai, p.waktu_selesai)), 2) as rata_rata_menit')
            )
            ->groupBy('a.nama_alat', 'l.nama_lab');

        if ($from) {
            $query->whereDate('p.waktu_mulai', '>=', $from);
        }
        if ($to) {
            $query->whereDate('p.waktu_selesai', '<=', $to);
        }

        $data = $query->get();

        return response()->json($data);
    }
}
