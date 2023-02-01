<?php

namespace App\Models\Tracker;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'featured_image_id',
    ];

    protected static function booted(): void
    {
        $clearCache = static function (Location $model): void {
            Cache::forget('tracker.locations.index');
            Cache::forget('tracker.locations.'.$model->id.'.rankings');

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
}
