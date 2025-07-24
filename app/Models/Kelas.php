<?php

// Lokasi: app/Models/Kelas.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'tahun_ajaran',
        'wali_kelas_id',
    ];

    // Relasi: Satu kelas dimiliki oleh satu pengajar (wali kelas)
    public function waliKelas(): BelongsTo
    {
        return $this->belongsTo(Pengajar::class, 'wali_kelas_id');
    }

    // Relasi: Satu kelas memiliki banyak santri
    public function santri(): HasMany
    {
        return $this->hasMany(Santri::class, 'kelas_id');
    }
}