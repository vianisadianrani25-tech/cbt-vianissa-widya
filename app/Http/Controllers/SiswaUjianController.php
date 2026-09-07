<?php

namespace App\Http\Controllers;

use App\Models\HasilUjian;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaUjianController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mengambil semua ujian yang dipublish
        $ujians = Ujian::with(['mapel', 'soals'])
            ->where('status', 'published')
            ->orderBy('id', 'desc')
            ->get();

        // Mengambil hasil ujian siswa ini
        $hasilMap = HasilUjian::where('user_id', $user->id)
            ->get()
            ->keyBy('ujian_id');

        return view('siswa.dashboard', compact('ujians', 'hasilMap'));
    }

    public function kerjakan(Ujian $ujian)
    {
        $user = Auth::user();

        if ($ujian->status !== 'published') {
            return redirect()->route('siswa.dashboard')->with('error', 'Ujian ini belum dipublish atau sudah ditutup.');
        }

        // Cek atau buat record HasilUjian
        $hasil = HasilUjian::firstOrCreate(
            ['user_id' => $user->id, 'ujian_id' => $ujian->id],
            ['status' => 'berlangsung', 'waktu_mulai' => now()]
        );

        // Jika sudah selesai, langsung arahkan ke halaman hasil
        if ($hasil->status === 'selesai') {
            return redirect()->route('siswa.ujian.hasil', $ujian->id);
        }

        $soals = $ujian->soals;

        return view('siswa.ujian.kerjakan', compact('ujian', 'soals', 'hasil'));
    }

    public function submit(Request $request, Ujian $ujian)
    {
        $user = Auth::user();
        $jawabanInput = $request->input('jawaban', []);

        $soals = $ujian->soals;
        $totalSoal = $soals->count();

        $jumlahBenar = 0;
        $jumlahSalah = 0;

        foreach ($soals as $soal) {
            $jawabanSiswa = strtolower($jawabanInput[$soal->id] ?? '');
            $jawabanBenar = strtolower($soal->jawaban_benar);

            if ($jawabanSiswa !== '' && $jawabanSiswa === $jawabanBenar) {
                $jumlahBenar++;
            } else {
                $jumlahSalah++;
            }
        }

        $nilai = $totalSoal > 0 ? (int) round(($jumlahBenar / $totalSoal) * 100) : 0;

        HasilUjian::updateOrCreate(
            ['user_id' => $user->id, 'ujian_id' => $ujian->id],
            [
                'nilai' => $nilai,
                'jumlah_benar' => $jumlahBenar,
                'jumlah_salah' => $jumlahSalah,
                'waktu_selesai' => now(),
                'status' => 'selesai',
            ]
        );

        return redirect()->route('siswa.ujian.hasil', $ujian->id)->with('success', 'Selamat, ujian telah selesai dikerjakan!');
    }

    public function hasil(Ujian $ujian)
    {
        $user = Auth::user();
        $hasil = HasilUjian::where('user_id', $user->id)
            ->where('ujian_id', $ujian->id)
            ->firstOrFail();

        return view('siswa.ujian.hasil', compact('ujian', 'hasil'));
    }
}
