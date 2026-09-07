<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Exports\HasilUjianExport;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request; // FUNGSI IMPORT
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // 1. Menampilkan halaman daftar laporan
    public function index()
    {
        $ujians = Ujian::with('mapel')->latest()->get();
        return view('laporan.index', compact('ujians'));
    }

    // 2. Export nilai ujian ke Excel
    public function exportExcel(Ujian $ujian)
    {
        $namaFile = 'hasil-ujian-' . str($ujian->judul)->slug() . '.xlsx';
        return Excel::download(new HasilUjianExport($ujian->id), $namaFile);
    }

    // 3. Import data siswa dari Excel
    public function importSiswa(Request $request)
    {
        // Validasi file yang diupload harus berupa excel/csv
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Proses import
        Excel::import(new SiswaImport(), $request->file('file_excel'));

        // Kembalikan ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Data siswa berhasil diimpor!');
    }

    public function exportPdf(Ujian $ujian)
    {
        // 1. Ambil data nilai yang berhubungan dengan ujian ini
        $hasilUjians = \App\Models\HasilUjian::with('user', 'ujian.mapel')
            ->where('ujian_id', $ujian->id)
            ->orderByDesc('nilai')
            ->get();

        // 2. Hubungkan data dengan template PDF yang baru kita buat
        $pdf = Pdf::loadView('pdf.hasil-ujian', [
            'ujian' => $ujian,
            'hasilUjians' => $hasilUjians,
        ])->setPaper('a4', 'portrait');

        $namaFile = 'hasil-ujian-' . str($ujian->judul)->slug() . '.pdf';

        // 3. Gunakan stream() agar PDF terbuka di tab baru, bukan langsung terunduh secara tersembunyi
        return $pdf->stream($namaFile);
    }
}