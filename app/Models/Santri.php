<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Supaya bisa pakai fitur Auth bawaan Laravel
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;

class Santri extends Authenticatable
{
    use HasFactory;

    protected $table = 'santri';

    protected $fillable = [
        'nis',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'nama_wali',
        'no_telepon_wali',
        'tanggal_masuk',
        'status',
        'kelas_id',
        'password', // penting untuk mass assignment
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Enkripsi password santri saat dibuat atau saat nis diubah.
     */
    protected static function booted()
    {
        static::creating(function ($santri) {
            if (empty($santri->password)) {
                $santri->password = Hash::make($santri->nis);
            }
        });

        static::updating(function ($santri) {
            if ($santri->isDirty('nis')) {
                $santri->password = Hash::make($santri->nis);
            }
        });
    }

    /**
     * Relasi: Santri milik satu kelas.
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
