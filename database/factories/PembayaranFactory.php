<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PembayaranFactory extends Factory
{
    public function definition(): array
    {
        $jenis = fake()->randomElement(['SPP', 'Ujian', 'Pembangunan']);
        return [
            'jenis_pembayaran' => $jenis,
            'bulan_pembayaran' => $jenis == 'SPP' ? fake()->monthName() . ' ' . fake()->year() : null,
            'jumlah_bayar' => fake()->randomElement([150000, 200000, 250000]),
            'tanggal_bayar' => fake()->dateTimeBetween('-1 year', 'now'),
            'status' => 'Lunas',
        ];
    }
}