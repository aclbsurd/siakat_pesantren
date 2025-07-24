<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class Pengajar extends Authenticatable
{
    use HasFactory;

    protected $table = 'pengajar';

    protected $fillable = [
        'nip',
        'nama_lengkap',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Set password saat pertama kali dibuat atau jika NIP diubah.
     */
    protected static function booted()
    {
        static::creating(function ($pengajar) {
            if (empty($pengajar->password)) {
                $pengajar->password = Hash::make($pengajar->nip);
            }
        });

        static::updating(function ($pengajar) {
            if ($pengajar->isDirty('nip')) {
                $pengajar->password = Hash::make($pengajar->nip);
            }
        });
    }

    /**
     * Relasi: Satu pengajar bisa menjadi wali untuk banyak kelas.
     */
    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class, 'wali_kelas_id');
    }
}
