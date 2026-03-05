<?php

namespace Database\Factories;

use App\Models\Pembimbing;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penilaian>
 */
class PenilaianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $kedisiplinan = $this->faker->numberBetween(70, 100);
        $kerjaSama = $this->faker->numberBetween(70, 100);
        $responsibilitas = $this->faker->numberBetween(70, 100);
        $nilaiAkhir = ($kedisiplinan + $kerjaSama + $responsibilitas) / 3;

        return [
            'id_guru' => Pembimbing::factory(),
            'id_siswa' => Siswa::factory(),
            'kedisipinan' => $kedisiplinan,
            'kerja_sama' => $kerjaSama,
            'responsibilitas' => $responsibilitas,
            'nilai_akhir' => round($nilaiAkhir, 2),
        ];
    }
}
