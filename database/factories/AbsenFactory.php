<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absen>
 */
class AbsenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $waktu_datang = Carbon::now()->format('H:i:s');
        $waktu_pulang = Carbon::now()->addHours(8)->format('H:i:s');

        return [
            'user_id' => rand(1, 5),
            'date' => Carbon::now(),
            'waktu_datang' => $waktu_datang,
            'waktu_pulang' => $waktu_pulang,
            'komen' => fake()->sentence(10),
        ];
    }
}
