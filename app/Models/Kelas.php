<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Request;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'name',
        'jumlah',
    ];

    // Relasi dengan Dosen (Satu kelas memiliki satu dosen, dosen menyimpan id kelas)
    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'kelas_id');
    }

    // Relasi dengan Mahasiswa (Satu kelas memiliki banyak mahasiswa)
    public function mahasiswa(): HasMany
    {
        return $this->hasMany(Mahasiswa::class);
    }

    // Relasi dengan Request (Request terkait dengan kelas)
    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }
}
