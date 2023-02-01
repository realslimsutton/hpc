<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'stream_url',
        'location_id',
        'game_rules_id',
        'stake_id',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    protected static function booted(): void
    {
        $clearCache = static function (Session $session): void {
            Cache::forget('tracker.sessions.find.'.$session->id);
            Cache::forget('tracker.locations.index');
            Cache::forget('tracker.locations.'.$session->location_id.'.rankings');

            Cache::forget('tracker.sessions.latest');
        };

        static::created($clearCache);
        static::updated($clearCache);
        static::deleted($clearCache);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function game_rules(): BelongsTo
    {
        return $this->belongsTo(GameRule::class);
    }

    public function stake(): BelongsTo
    {
        return $this->belongsTo(Stake::class);
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class)
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
