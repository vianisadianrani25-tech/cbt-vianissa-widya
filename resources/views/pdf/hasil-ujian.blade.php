<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Ujian</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #1f2430; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #e74c3c; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #c0392b; }
        .info-table { width: 100%; margin-bottom: 15px; }
        .info-table td { padding: 3px 0; }
        table.data { width: 100%; border-collapse: collapse; }
        table.data th, table.data td { border: 1px solid #999; padding: 6px 8px; font-size: 11px; }
        table.data th { background-color: #e74c3c; color: #fff; }
        .text-center { text-align: center; }
        .footer { margin-top: 30px; font-size: 10px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Hasil Ujian</h2>
        <p>{{ $ujian->judul }} — {{ $ujian->mapel->nama_mapel ?? 'N/A' }}</p>
    </div>

    <table class="info-table">
        <tr>
            <td><strong>Tanggal Ujian</strong></td>
            {{-- Menggunakan format tanggal dari kolom yang sudah kita pastikan ada di DB (tanggal_mulai) --}}
            <td>: {{ \Carbon\Carbon::parse($ujian->tanggal_mulai)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td><strong>Jumlah Peserta</strong></td>
            <td>: {{ $hasilUjians->count() }} siswa</td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>NIS</th>
                <th>Nilai</th>
                <th>Benar</th>
                <th>Salah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasilUjians as $index => $hasil)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $hasil->user->name }}</td>
                    <td class="text-center">{{ $hasil->user->nis ?? '-' }}</td>
                    <td class="text-center">{{ $hasil->nilai }}</td>
                    <td class="text-center">{{ $hasil->jumlah_benar }}</td>
                    <td class="text-center">{{ $hasil->jumlah_salah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada {{ now()->translatedFormat('d F Y, H:i') }} WIB
    </div>
</body>
</html>