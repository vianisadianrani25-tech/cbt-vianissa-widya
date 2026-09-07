<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ujian extends Model
{
    protected $fillable = [
        'mapel_id', 'judul', 'durasi_menit',
        'tanggal_mulai', 'tanggal_selesai', 'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'datetime',
            'tanggal_selesai' => 'datetime',
        ];
    }

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class);
    }

    public function soals(): BelongsToMany
    {
        return $this->belongsToMany(Soal::class, 'soal_ujian')
            ->withPivot('urutan')
            ->orderBy('soal_ujian.urutan');
    }

    public function hasilUjians(): HasMany
    {
        return $this->hasMany(HasilUjian::class);
    }
}