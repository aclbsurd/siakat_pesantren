<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'user_id',
        'isi_pesan',
        'status',
        'tanggal',
    ];

    /**
     * Relasi ke tabel users (pengirim pengaduan)
     */public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
