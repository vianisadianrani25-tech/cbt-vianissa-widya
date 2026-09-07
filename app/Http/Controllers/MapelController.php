<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::latest()->get();
        return view('mapel.index', compact('mapels'));
    }

    public function create()
    {
        return view('mapel.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'kode_mapel' => 'required|string|max:50|unique:mapels,kode_mapel',
        ]);

        // 2. Simpan ke database (Sama persis seperti perintah Tinker!)
        Mapel::create($validated);

        // 3. Kembalikan ke halaman daftar dengan pesan sukses
        return redirect()->route('guru.mapel.index')->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }

    public function edit(Mapel $mapel)
    {
        return view('mapel.edit', compact('mapel'));
    }

    public function update(Request $request, Mapel $mapel)
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'kode_mapel' => 'required|string|max:50|unique:mapels,kode_mapel,' . $mapel->id,
        ]);

        $mapel->update($validated);

        return redirect()->route('guru.mapel.index')->with('success', 'Mata Pelajaran berhasil diperbarui.');
    }

    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        return redirect()->route('guru.mapel.index')->with('success', 'Mata Pelajaran berhasil dihapus.');
    }
}