<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matakuliah extends Model
{
    use HasFactory;
    protected $table = 'matakuliahs';
    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'modul',
    ];
    protected function casts(): array
    {
        return [
            'sks' => 'integer',
            'semester' => 'integer',
        ];
    }
public function jadwalKuliah(): HasMany
    {
        return $this->hasMany(JadwalKuliah::class);
    }
}