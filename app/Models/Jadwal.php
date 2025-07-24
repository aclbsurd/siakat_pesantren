<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jadwal extends Model
{
    protected $table = 'jadwal'; // ← opsional, hanya jika tidak sesuai konvensi

    protected $fillable = [
        'pengajar_id',
        'kelas_id',
        'hari',
        'jam',
        'mapel',
    ];

    /**
     * Relasi ke tabel pengajar
     */
    public function pengajar(): BelongsTo
    {
        return $this->belongsTo(Pengajar::class, 'pengajar_id');
    }

    /**
     * Relasi ke tabel kelas
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
