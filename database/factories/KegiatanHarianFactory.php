<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KegiatanHarian>
 */
class KegiatanHarianFactory extends Factory
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
            'deskripsi_kegiatan' => $this->faker->paragraph(),
            'file' => null,
        ];
    }
}
