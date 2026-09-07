<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Soal extends Model
{
    protected $fillable = [
        'mapel_id', 'created_by', 'pertanyaan',
        'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d',
        'jawaban_benar', 'tingkat_kesulitan',
    ];

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class);
    }

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function ujians(): BelongsToMany
    {
        return $this->belongsToMany(Ujian::class, 'soal_ujian')->withPivot('urutan');
    }
}