<?php

// database/factories/PengajarFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PengajarFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nip' => fake()->unique()->numerify('198#######202#####'),
            'nama_lengkap' => fake()->name(),
            'jenis_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'alamat' => fake()->address(),
            'no_telepon' => fake()->phoneNumber(),
        ];
    }
}