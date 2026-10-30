<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Jadwalkuliah extends Model
{
    use HasFactory;
    protected $table = 'jadwalkuliah';

    protected $fillable = [
        'kelas_id',
        'matakuliah_id', // Pastikan ini ada dan namanya sesuai
        'dosen_id',
        'ruangan_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        // Pastikan ini juga ada
    ];

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(kelas::class);
    }
    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(Matakuliah::class, 'matakuliah_id');
    }
public function dosen(): BelongsTo
{
    return $this->belongsTo(Dosen::class);
}

public function ruangan(): BelongsTo
{
    return $this->belongsTo(Ruangan::class);
}

  public function lampiran(): HasMany
    {
        return $this->hasMany(LampiranJadwal::class, 'jadwal_kuliah_id');
    }
}


