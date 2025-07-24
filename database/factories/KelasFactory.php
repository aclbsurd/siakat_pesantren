<?php

// database/factories/KelasFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KelasFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_kelas' => 'Kelas ' . fake()->randomElement(['I,DAD', 'WUSTHA', 'ULYA', 'ULA']),
            'tahun_ajaran' => fake()->randomElement(['2024/2025', '2025/2026']),
        ];
    }
}