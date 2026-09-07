<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    // Mengambil semua data mapel beserta jumlah soal
    public function index()
    {
        $mapels = Mapel::withCount('soals')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data mapel berhasil diambil',
            'data'    => $mapels,
        ], 200);
    }

    // Mengambil detail satu data mapel berdasarkan ID
    public function show($id)
    {
        $mapel = Mapel::with('soals')->find($id);

        if (!$mapel) {
            return response()->json([
                'success' => false,
                'message' => 'Data mapel tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data mapel ditemukan',
            'data'    => $mapel,
        ], 200);
    }
    // Menyimpan data mapel baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_mapel' => 'required|string|max:255',
            'kode_mapel' => 'required|string|max:50|unique:mapels,kode_mapel',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $mapel = Mapel::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data mapel berhasil dibuat',
            'data'    => $mapel,
        ], 201);
    }
    // Mengubah data mapel yang sudah ada
    public function update(Request $request, $id)
    {
        $mapel = Mapel::find($id);

        if (!$mapel) {
            return response()->json([
                'success' => false,
                'message' => 'Data mapel tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_mapel' => 'required|string|max:255',
            // Abaikan pengecekan unique untuk ID mapel yang sedang diubah saat ini
            'kode_mapel' => 'required|string|max:50|unique:mapels,kode_mapel,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $mapel->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data mapel berhasil diubah',
            'data'    => $mapel,
        ], 200);
    }

    // Menghapus data mapel berdasarkan ID
    public function destroy($id)
    {
        $mapel = Mapel::find($id);

        if (!$mapel) {
            return response()->json([
                'success' => false,
                'message' => 'Data mapel tidak ditemukan',
            ], 404);
        }

        $mapel->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data mapel berhasil dihapus',
        ], 200);
    }
}
