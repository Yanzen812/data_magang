<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 75% siswa role dengan siswa_id, 25% admin tanpa siswa_id
        $role = fake()->randomElement(['siswa', 'siswa', 'siswa', 'admin']);
        
        return [
            'username' => fake()->unique()->userName(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => $role,
            'siswa_id' => $role === 'siswa' ? Siswa::factory() : null,
        ];
    }

    /**
     * Create an admin user.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
            'siswa_id' => null,
        ]);
    }

    /**
     * Create a siswa user.
     */
    public function siswa(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'siswa',
            'siswa_id' => Siswa::factory(),
        ]);
    }
}
