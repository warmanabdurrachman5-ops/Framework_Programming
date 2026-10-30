<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LampiranJadwal extends Model
{
    protected $table = 'lampiran_jadwal';

    protected $fillable = [
        'jadwal_kuliah_id',
        'path',
        'nama_asli',
    ];

    public function jadwalKuliah(): BelongsTo
    {
        return $this->belongsTo(Jadwalkuliah::class, 'jadwal_kuliah_id');
    }
}
