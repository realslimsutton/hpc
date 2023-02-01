<?php

namespace App\Models\Tracker;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subscriber_count',
        'featured_image_id',
    ];

    protected static function booted(): void
    {
        $clearCache = static function (Location $location): void {
            Cache::forget('tracker.locations.index');
            Cache::forget('tracker.locations.' . $location->id . '.rankings');
            Cache::forget('tracker.locations.find.' . $location->id);

            Cache::forget('tracker.sessions.latest');
        };

        static::created($clearCache);
        static::updated($clearCache);
        static::deleted($clearCache);
    }

    public function featured_image(): HasOne
    {
        return $this->hasOne(Media::class, 'id', 'featured_image_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    public function player_sessions(): HasManyThrough
    {
        return $this->hasManyThrough(
            PlayerSession::class,
            Session::class
        );
    }
}
