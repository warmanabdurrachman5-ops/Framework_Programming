<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan';

    protected $fillable = [
        'code_ruangan',
        'nama',
        'gedung',
        'kapasitas',
        'is_leb',
    ];

    protected function casts(): array
    {
        return[
            'kapasitas' => 'integer',
            'is_leb' => 'boolean',
        ];
    }
    public function jadwalkuliah(): HasMany
    {
        return $this->hasMany(Jadwalkuliah::class);
    }
}
