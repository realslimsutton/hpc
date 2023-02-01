<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class GameRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
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
