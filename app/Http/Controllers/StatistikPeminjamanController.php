<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class StatistikPeminjamanController extends Controller
{
    public function statusPeminjaman(Request $request)
    {
        $query = Peminjaman::query();

        if ($request->filled('from')) {
            $query->whereDate('tanggal_peminjaman', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('tanggal_peminjaman', '<=', $request->to);
        }

        $data = $query->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // fallback kalau kosong → kasih nol biar chart tetap tampil
        if ($data->isEmpty()) {
            $data = collect([
                'Belum Dicek' => 0,
                'Ditolak' => 0,
                'Diterima' => 0,
            ]);
        }

        return response()->json([
            'labels' => $data->keys(),
            'series' => $data->values(),
        ]);
    }

    public function laboratoriumPeminjaman(Request $request)
    {
        $from = $request->from;
        $to   = $request->to;

        $q = Peminjaman::query();

        if ($from) $q->whereDate('tanggal_peminjaman', '>=', $from);
        if ($to)   $q->whereDate('tanggal_peminjaman', '<=', $to);

        // sesuaikan nama tabel jika beda (mis. 'peminjamen' / 'laboratoria')
        $data = $q->join('laboratoria', 'peminjamen.laboratorium_id', '=', 'laboratoria.id')
            ->select('laboratoria.nama_lab', DB::raw('COUNT(*) as total'))
            ->groupBy('laboratoria.nama_lab')
            ->orderByDesc('total')
            ->pluck('total', 'laboratoria.nama_lab');

        if ($data->isEmpty()) {
            $data = collect(['Tidak ada data' => 0]);
        }

        return response()->json([
            'labels' => $data->keys()->toArray(),
            'series' => $data->values()->toArray(),
        ]);
    }

    public function harianPeminjaman(Request $request)
    {
        $query = \App\Models\Peminjaman::query();

        // Filter tanggal kalau ada
        if ($request->filled('from')) {
            $query->whereDate('tanggal_peminjaman', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('tanggal_peminjaman', '<=', $request->to);
        }

        $data = $query
            ->selectRaw('DATE(tanggal_peminjaman) as tanggal, COUNT(*) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return response()->json([
            'labels' => $data->map(fn($row) => \Carbon\Carbon::parse($row->tanggal)->format('d M')),
            'series' => $data->pluck('total'),
        ]);
    }

    public function instrukturPeminjaman(Request $request)
    {
        $query = DB::table('peminjamen')
            ->join('instrukturs', 'peminjamen.instruktur_id', '=', 'instrukturs.id')
            ->select('instrukturs.nama_instruktur as instruktur', \DB::raw('COUNT(peminjamen.id) as total'));

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('peminjamen.tanggal_peminjaman', [$request->from, $request->to]);
        }

        $query->groupBy('instrukturs.nama_instruktur');

        $data = $query->get();

        return response()->json([
            'labels' => $data->pluck('instruktur'),
            'series' => $data->pluck('total'),
        ]);
    }
}
