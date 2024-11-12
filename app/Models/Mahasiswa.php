<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'kelas_id',
        'nim',
        'name',
        'tempat_lahir',
        'tanggal_lahir',
        'edit',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relasi dengan User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Kelas (Mahasiswa bisa memilih banyak kelas berbeda)
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    // Relasi dengan Request (Mahasiswa bisa memiliki banyak request)
    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }
}
