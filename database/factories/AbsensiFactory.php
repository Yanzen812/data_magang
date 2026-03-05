<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absensi>
 */
class AbsensiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'siswa_id' => Siswa::factory(),
            'tanggal' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'waktu_datang' => $this->faker->time('H:i:s'),
            'status' => $this->faker->randomElement(['h', 'i', 's', 't']),
            'file' => null,
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
