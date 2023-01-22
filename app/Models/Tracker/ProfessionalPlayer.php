<?php

namespace App\Models\Tracker;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;

class ProfessionalPlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'biography',
        'enabled',
        'featured_image_id'
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    protected static function booted(): void
    {
        $clearCache = static function() {
            Cache::forget('tracking.index.locations');

            foreach(Location::query()->lazy() as $model) {
                Cache::forget('tracking.index.location.' . $model->id . '.rankings.highest');
                Cache::forget('tracking.index.location.' . $model->id . '.rankings.lowest');
            }

            Cache::forget('tracking.index.latest-sessions');
        };

        static::created($clearCache);
        static::updated($clearCache);
        static::deleted($clearCache);
    }

    public function professional_sessions(): BelongsToMany
    {
        return $this->belongsToMany(ProfessionalSession::class, 'professional_player_sessions')
            ->using(ProfessionalPlayerSession::class)
            ->withPivot([
                'id',
                'net_winnings',
                'vpip',
                'pfr',
                'hours_played',
            ]);
    }

    public function featured_image(): HasOne
    {
        return $this->hasOne(Media::class, 'id');
    }
}
