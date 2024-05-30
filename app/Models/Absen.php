<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absen extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'waktu_datang',
        'waktu_pulang',
        'komen',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
