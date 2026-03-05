<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembimbing>
 */
class PembimbingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_pembimbing' => $this->faker->name(),
            'kontak' => $this->faker->phoneNumber(),
            'asal_sekolah' => $this->faker->company(),
        ];
    }
}
