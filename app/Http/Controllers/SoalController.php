<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SoalController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $soals = Soal::with('mapel', 'pembuat')->latest()->paginate(15);
        return view('soal.index', compact('soals'));
    }

    public function create()
    {
        $mapels = Mapel::all();
        return view('soal.create', compact('mapels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mapel_id' => 'required|exists:mapels,id',
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string|max:255',
            'pilihan_b' => 'required|string|max:255',
            'pilihan_c' => 'required|string|max:255',
            'pilihan_d' => 'required|string|max:255',
            'jawaban_benar' => 'required|in:a,b,c,d',
            'tingkat_kesulitan' => 'required|in:mudah,sedang,sulit',
        ]);

        $validated['created_by'] = $request->user()->id;

        Soal::create($validated);

        // Perhatikan penggunaan 'guru.soal.index' sesuai nama route yang akan kita daftarkan
        return redirect()->route('guru.soal.index')->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit(Soal $soal)
    {
        $this->authorize('update', $soal);
        $mapels = Mapel::all();
        return view('soal.edit', compact('soal', 'mapels'));
    }

    public function update(Request $request, Soal $soal)
    {
        $this->authorize('update', $soal);

        $validated = $request->validate([
            'mapel_id' => 'required|exists:mapels,id',
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string|max:255',
            'pilihan_b' => 'required|string|max:255',
            'pilihan_c' => 'required|string|max:255',
            'pilihan_d' => 'required|string|max:255',
            'jawaban_benar' => 'required|in:a,b,c,d',
            'tingkat_kesulitan' => 'required|in:mudah,sedang,sulit',
        ]);

        $soal->update($validated);

        return redirect()->route('guru.soal.index')->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Soal $soal)
    {
        $this->authorize('delete', $soal);
        $soal->delete();
        return redirect()->route('guru.soal.index')->with('success', 'Soal berhasil dihapus.');
    }
}
