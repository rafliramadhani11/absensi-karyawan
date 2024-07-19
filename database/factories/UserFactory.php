<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $tanggalLahir = fake()->date();
        $jeniskelamin = fake()->randomElement(['Laki - Laki', 'Perempuan']);
        $jabatan = fake()->randomElement([
            'Direktur Utama', 'Manajer Proyek', 'Pengawas Lapangan', 'Kepala Gudang', 'Finance', 'Purchasing', 'Supervisor',
        ]);


        return [
            'nik' => fake()->numerify('################'),
            'name' => 'Admin',
            'slug' => 'Admin',
            'jeniskelamin' => 'Laki - Laki',
            'jabatan' => 'Kepala Gudang',
            'alamat' => 'Admin',
            'tanggalLahir' => fake()->date(),

            'email' => 'admin@mail.com',
            'admin' => 1,

            'password' => static::$password ??= Hash::make('123'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
