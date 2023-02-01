<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Stake extends Model
{
    use HasFactory;

    protected $fillable = [
        'small_blind',
        'big_blind',
    ];

    protected $casts = [
        'small_blind' => 'integer',
        'big_blind' => 'integer',
    ];

    protected static function booted(): void
    {
        $clearCache = static function () {
            Cache::forget('tracker.sessions.latest');
        };

        static::updated($clearCache);
        static::deleted($clearCache);
    }
}
