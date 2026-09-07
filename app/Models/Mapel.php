<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapels'; // Sesuaikan jika nama tabel Anda berbeda

    protected $fillable = [
        'nama_mapel',
        'kode_mapel',
    ];

    // Relasi ke tabel Soal
    public function soals()
    {
        return $this->hasMany(Soal::class);
    }
}