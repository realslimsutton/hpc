<?php

namespace App\Models\Tracker;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;
use Squire\Models\Country;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nickname',
        'biography',
        'profession',
        'date_of_birth',
        'twitter_url',
        'twitter_handle',
        'country_id',
        'hometown',
        'featured_image_id',
        'enabled',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'date_of_birth' => 'datetime',
    ];

    protected static function booted(): void
    {
        $clearCache = static function (Player $player) {
            Cache::forget('tracker.players.find.'.$player->id);
            Cache::forget('tracker.locations.index');

            foreach (Location::all() as $model) {
                Cache::forget('tracker.locations.'.$model->id.'.rankings');
            }

            Cache::forget('tracker.sessions.latest');
        };

        static::created($clearCache);
        static::updated($clearCache);
        static::deleted($clearCache);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function featured_image(): HasOne
    {
        return $this->hasOne(Media::class, 'id', 'featured_image_id');
    }

    public function sessions(): BelongsToMany
    {
        return $this->belongsToMany(Session::class)
            ->using(PlayerSession::class)
            ->withPivot([
                'id',
                'net_winnings',
                'vpip',
                'pfr',
                'hours_played',
            ]);
    }
}
