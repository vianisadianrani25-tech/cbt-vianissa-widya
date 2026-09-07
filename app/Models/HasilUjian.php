<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilUjian extends Model
{
    use HasFactory;

    // Pastikan nama tabelnya tidak salah (opsional jika Laravel sudah otomatis menebak)
    protected $table = 'hasil_ujians'; 

    protected $guarded = ['id'];

    // 1. Relasi ke tabel users (untuk mendapatkan nama siswa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 2. Relasi ke tabel ujians (untuk mendapatkan data ujian)
    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
}