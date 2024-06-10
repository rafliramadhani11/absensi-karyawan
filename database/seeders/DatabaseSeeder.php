<?php

namespace Database\Seeders;

use App\Models\Absen;
use App\Models\Gaji;
use App\Models\Hadir;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create();
        //Hadir::factory(30)->create();
        //Gaji::factory(10)->create();
    }
}
