<?php

namespace Database\Factories;

use App\Models\Pembimbing;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Surat_pengantar>
 */
class SuratPengantarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file' => 'surat_' . $this->faker->uuid . '.pdf',
            'kelompok' => implode(', ', $this->faker->names(3)),
            'id_pembimbing' => Pembimbing::factory(),
            'id_siswa' => Siswa::factory(),
            'status' => $this->faker->randomElement(['pending', 'verified', 'rejected']),
        ];
    }
}
