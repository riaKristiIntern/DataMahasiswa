<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'user_id',
        'kode_dosen',
        'nip',
        'name',
        'kelas_id',
    ];

    // Relasi dengan User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Kelas (Dosen memiliki satu kelas)
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    // Relasi dengan Mahasiswa melalui Kelas
    public function mahasiswa(): HasManyThrough
    {
        return $this->hasManyThrough(Mahasiswa::class, Kelas::class, 'id', 'kelas_id', 'kelas_id', 'id');
    }
}
