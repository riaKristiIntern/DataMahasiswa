<?php

namespace App\Models;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kaprodi extends Model
{
    use HasFactory;

    protected $table = 'kaprodi';

    protected $fillable = [
        'user_id',
        'kode_dosen',
        'nip',
        'name',
    ];

    // Relasi dengan User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Dosen (Kaprodi bisa mengelola dosen)
    public function dosens(): HasMany
    {
        return $this->hasMany(Dosen::class);
    }

    // Relasi dengan Kelas (Kaprodi mengelola kelas)
    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class);
    }
}
