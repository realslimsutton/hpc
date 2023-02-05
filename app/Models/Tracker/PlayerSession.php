<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Cache;

class PlayerSession extends Pivot
{
    protected $table = 'player_session';

    protected $fillable = [
        'player_id',
        'session_id',
        'net_winnings',
        'vpip',
        'pfr',
        'hours_played',
    ];

    protected static function booted(): void
    {
        $clearCache = static function (PlayerSession $playerSession) {
            Cache::forget('tracker.players.find.'.$playerSession->player_id);
            Cache::forget('tracker.sessions.find.'.$playerSession->session_id);
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

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }
}
