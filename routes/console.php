<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    $today = now()->toDateString();
    $users = User::where('admin', 0)->get();

    foreach ($users as $user) {
        $attendanceExists = $user->hadirs()->whereDate('created_at', $today)->exists();

        if (!$attendanceExists) {
            $user->hadirs()->create([
                'status' => 'Alfa',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
})->dailyAt('17:00');;
