<?php

namespace Database\Factories;

use App\Models\Pembimbing;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Surat_pengantar>
 */
class Surat_PengantarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            $this->faker->name(),
            $this->faker->name(),
            $this->faker->name(),
        ];

        return [
            'file' => 'surat_' . $this->faker->uuid . '.pdf',
            'kelompok' => implode(', ', $names),
            'id_pembimbing' => Pembimbing::factory(),
            'id_siswa' => Siswa::factory(),
            'status' => $this->faker->randomElement(['pending', 'verified', 'rejected']),
        ];
    }
}
