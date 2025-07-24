<?php

// database/factories/SantriFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SantriFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nis' => fake()->unique()->numerify('25####'),
            'nama_lengkap' => fake()->name(),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->dateTimeBetween('2008-01-01', '2012-12-31')->format('Y-m-d'),
            'jenis_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'alamat' => fake()->address(),
            'nama_wali' => fake()->name(),
            'no_telepon_wali' => fake()->phoneNumber(),
            'tanggal_masuk' => fake()->dateTimeBetween('2022-01-01', '2024-01-01')->format('Y-m-d'),
            'status' => 'Aktif',
        ];
    }
}