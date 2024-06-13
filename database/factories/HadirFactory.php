<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hadir>
 */
class HadirFactory extends Factory
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
        $bulanJuly = Carbon::createFromDate(2022, 7, fake()->numberBetween(1, 30));

        return [
            'user_id' => 1,
            'date' => $bulanJuly,
            'waktu_datang' => $waktu_datang,
            'waktu_pulang' => $waktu_pulang,

            'Hadir' => rand(0, 1),
            'Izin' => rand(0, 1),
            'Alfa' => rand(0, 1),

            // 'alasan' => fake()->sentence(10),
        ];
    }
}
