<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    use HasFactory;

    protected $table = 'request';

    protected $fillable = [
        'kelas_id',
        'mahasiswa_id',
        'keterangan',
    ];

    // Relasi dengan Kelas
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    // Relasi dengan Mahasiswa (Satu request dimiliki oleh satu mahasiswa)
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
