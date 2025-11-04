<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    public function store(Request $request){

        $validated = $request->validate([
            'nama_peminjam'        => 'required|string|max:100',
            'laboratorium_id'      => 'required|exists:laboratoria,id',
            'tanggal_peminjaman'   => 'required|date',
            'tanggal_pengembalian' => 'required|date|after_or_equal:tanggal_peminjaman',
            'keperluan'            => 'required|string|max:255',
            'instruktur_id'        => 'required|exists:instrukturs,id',
        ], [
            'required' => ':attribute wajib diisi.',
            'after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.',
            'exists' => ':attribute tidak valid.',
        ]);

        try {
            Peminjaman::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Data peminjaman berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data.'
            ], 500);
        }
    }
}
