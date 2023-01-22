<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class PokerGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected static function booted(): void
    {
        $clearCache = static function() {
            Cache::forget('tracking.index.latest-sessions');
        };

        static::updated($clearCache);
        static::deleted($clearCache);
    }

    public function professional_sessions(): HasMany
    {
        return $this->hasMany(ProfessionalSession::class);
    }
}
