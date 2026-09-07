<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Soal;
use App\Models\Ujian;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function index()
    {
        $ujians = Ujian::with(['mapel', 'soals'])->orderBy('id', 'desc')->get();
        return view('ujian.index', compact('ujians'));
    }

    public function create()
    {
        $mapels = Mapel::all();
        $soals = Soal::with('mapel')->orderBy('mapel_id')->get();
        return view('ujian.create', compact('mapels', 'soals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'mapel_id' => 'required|exists:mapels,id',
            'durasi_menit' => 'required|integer|min:5|max:300',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'required|in:draft,published,selesai',
            'soal_ids' => 'nullable|array',
            'soal_ids.*' => 'exists:soals,id',
        ]);

        $ujian = Ujian::create([
            'judul' => $validated['judul'],
            'mapel_id' => $validated['mapel_id'],
            'durasi_menit' => $validated['durasi_menit'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'status' => $validated['status'],
        ]);

        // Langsung hubungkan soal-soal terpilih jika ada
        if (!empty($validated['soal_ids'])) {
            $syncData = [];
            foreach ($validated['soal_ids'] as $index => $soalId) {
                $syncData[$soalId] = ['urutan' => $index + 1];
            }
            $ujian->soals()->sync($syncData);
        }

        return redirect()->route('guru.ujian.index')->with('success', 'Sesi Ujian dan soal-soal terpilih berhasil disimpan.');
    }

    public function edit(Ujian $ujian)
    {
        $mapels = Mapel::all();
        $soals = Soal::with('mapel')->orderBy('mapel_id')->get();
        $selectedSoalIds = $ujian->soals->pluck('id')->toArray();

        return view('ujian.edit', compact('ujian', 'mapels', 'soals', 'selectedSoalIds'));
    }

    public function update(Request $request, Ujian $ujian)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'mapel_id' => 'required|exists:mapels,id',
            'durasi_menit' => 'required|integer|min:5|max:300',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:draft,published,selesai',
            'soal_ids' => 'nullable|array',
            'soal_ids.*' => 'exists:soals,id',
        ]);

        $ujian->update([
            'judul' => $validated['judul'],
            'mapel_id' => $validated['mapel_id'],
            'durasi_menit' => $validated['durasi_menit'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'status' => $validated['status'],
        ]);

        // Sync soal-soal terpilih
        $syncData = [];
        if (!empty($validated['soal_ids'])) {
            foreach ($validated['soal_ids'] as $index => $soalId) {
                $syncData[$soalId] = ['urutan' => $index + 1];
            }
        }
        $ujian->soals()->sync($syncData);

        return redirect()->route('guru.ujian.index')->with('success', 'Data sesi ujian dan susunan soal berhasil diperbarui.');
    }

    public function destroy(Ujian $ujian)
    {
        $ujian->delete();
        return redirect()->route('guru.ujian.index')->with('success', 'Sesi ujian berhasil dihapus.');
    }

    public function toggleStatus(Ujian $ujian)
    {
        $ujian->status = ($ujian->status === 'published') ? 'draft' : 'published';
        $ujian->save();

        $statusText = $ujian->status === 'published' ? 'diterbitkan (Aktif untuk Siswa)' : 'dijadikan Draft (Non-aktif)';
        return redirect()->back()->with('success', "Status Ujian berhasil diubah menjadi {$statusText}.");
    }
}
