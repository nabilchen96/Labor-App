<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenggunaanAlat;

class PenggunaanAlatController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_nama'      => 'required|string|max:100',
            'peminjaman_id'  => 'required|exists:peminjamen,id',
            'waktu_mulai'    => 'required|date',
            'waktu_selesai'  => 'required|date|after_or_equal:waktu_mulai',
            'alat_id'        => 'required|exists:alat_laboratoria,id',
            'kondisi_awal'   => 'required|string|max:50',
            'catatan'        => 'required|string|max:255',
        ], [
            'required' => ':attribute wajib diisi.',
            'after_or_equal' => 'Waktu selesai tidak boleh sebelum waktu mulai.',
            'exists' => ':attribute tidak ditemukan di database.',
        ]);

        try {
            PenggunaanAlat::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Data penggunaan alat berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data.'
            ], 500);
        }
    }
}
