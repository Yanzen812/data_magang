<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'kontak' => $this->faker->phoneNumber(),
            'asal_sekolah' => $this->faker->company() . ' School',
            'jurusan' => $this->faker->randomElement(['TKJ', 'RPL', 'MM', 'DKV']),
            'periode' => $this->faker->randomElement(['2025-1', '2025-2', '2026-1']),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'kelompok' => 'Kelompok ' . $this->faker->numberBetween(1, 5),
        ];
    }
}
