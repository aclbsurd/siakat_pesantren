<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory;

    // Menentukan nama tabel karena jamak dari 'pembayaran' tidak standar
    protected $table = 'pembayaran';

    // Kolom yang boleh diisi
    protected $fillable = [
        'santri_id',
        'user_id',
        'jenis_pembayaran',
        'bulan_pembayaran',
        'jumlah_bayar',
        'tanggal_bayar',
        'status',
        'keterangan',
    ];

    // Relasi ke tabel Santri
    public function santri(): BelongsTo
    {
        return $this->belongsTo(Santri::class);
    }

    // Relasi ke tabel User (Admin yang menerima pembayaran)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}