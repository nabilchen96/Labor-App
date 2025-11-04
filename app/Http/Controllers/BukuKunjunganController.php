<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BukuKunjungan;

class BukuKunjunganController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pengunjung'       => 'required|string|max:100',
            'peminjaman_id'    => 'required|exists:peminjamen,id',
            'waktu_masuk'      => 'required|date',
            'waktu_keluar'     => 'required|date|after_or_equal:waktu_masuk',
            'keperluan'        => 'required|string|max:255',
        ], [
            'required' => ':attribute wajib diisi.',
            'after_or_equal' => 'Waktu keluar tidak boleh sebelum waktu masuk.',
            'exists' => 'Data peminjaman tidak valid.',
        ]);

        try {
            BukuKunjungan::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Data pengunjung berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data.'
            ], 500);
        }
    }
}
