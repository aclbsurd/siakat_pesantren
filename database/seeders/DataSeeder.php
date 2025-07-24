<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pengajar;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\Pembayaran;

class DataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin
        User::create([
            'nama' => 'Admin Pesantren',
            'username' => 'admin',
            'email' => 'admin@example.com', // optional
            'password' => Hash::make('password'), // password: password
        ]);

        // 2. Buat 15 Pengajar dengan password = nip
        Pengajar::factory()->count(15)->make()->each(function ($pengajar) {
            $pengajar->password = Hash::make($pengajar->nip); // password = nip
            $pengajar->save();
        });

        // 3. Buat 10 Kelas dan tetapkan wali_kelas dari pengajar secara acak
        $pengajars = Pengajar::all();
        Kelas::factory()->count(10)->make()->each(function ($kelas) use ($pengajars) {
            $kelas->wali_kelas_id = $pengajars->random()->id;
            $kelas->save();
        });

        // 4. Buat 200 Santri dan masukkan ke kelas, password = nis
        $kelases = Kelas::all();
        Santri::factory()->count(200)->make()->each(function ($santri) use ($kelases) {
            $santri->kelas_id = $kelases->random()->id;
            $santri->password = Hash::make($santri->nis); // password = nis
            $santri->status = 'Aktif';
            $santri->save();
        });

        // 5. Buat Data Pembayaran untuk santri aktif
        $adminUser = User::first();
        $santriAktif = Santri::where('status', 'Aktif')->get();

        foreach ($santriAktif as $santri) {
            Pembayaran::factory()->count(fake()->numberBetween(1, 3))->create([
                'santri_id' => $santri->id,
                'user_id' => $adminUser->id,
            ]);
        }
    }
}
