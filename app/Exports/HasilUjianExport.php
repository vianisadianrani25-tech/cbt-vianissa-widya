<?php

namespace App\Exports;

use App\Models\HasilUjian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class HasilUjianExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $ujianId;

    public function __construct($ujianId)
    {
        $this->ujianId = $ujianId;
    }

    public function collection()
    {
        return HasilUjian::with('user', 'ujian')
            ->where('ujian_id', $this->ujianId)
            ->orderByDesc('nilai')
            ->get();
    }

    public function headings(): array
    {
        return ['No', 'Nama Siswa', 'NIS', 'Mata Pelajaran', 'Nilai', 'Benar', 'Salah', 'Status'];
    }

    public function map($hasil): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $hasil->user->name,
            $hasil->user->nis,
            $hasil->ujian->mapel->nama_mapel,
            $hasil->nilai,
            $hasil->jumlah_benar,
            $hasil->jumlah_salah,
            ucfirst(str_replace('_', ' ', $hasil->status)),
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25,
            'C' => 15,
            'D' => 20,
            'E' => 10,
            'F' => 10,
            'G' => 10,
            'H' => 15,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header row: bold + background warna merah
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        $sheet->getStyle('A1:H1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('E74C3C');
        $sheet->getStyle('A1:H1')->getFont()->getColor()->setRGB('FFFFFF');

        // Rata tengah untuk kolom No, Nilai, Benar, Salah
        $sheet->getStyle('A:A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E:G')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return [];
    }
}