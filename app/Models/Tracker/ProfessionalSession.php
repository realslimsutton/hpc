<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;

class ProfessionalSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'stream_url',
        'location_id',
        'poker_game_id',
        'stake_id',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    protected static function booted(): void
    {
        $clearCache = static function (ProfessionalSession $model) {
            Cache::forget('tracking.index.locations');

            Cache::forget('tracking.index.location.'.$model->location_id.'.rankings.highest');
            Cache::forget('tracking.index.location.'.$model->location_id.'.rankings.lowest');

            Cache::forget('tracking.index.latest-sessions');
        };

        static::created($clearCache);
        static::updated($clearCache);
        static::deleted($clearCache);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function poker_game(): BelongsTo
    {
        return $this->belongsTo(PokerGame::class);
    }

    public function stake(): BelongsTo
    {
        return $this->belongsTo(Stake::class);
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(ProfessionalPlayer::class, 'professional_player_sessions')
            ->using(ProfessionalPlayerSession::class)
            ->withPivot([
                'id',
                'net_winnings',
                'vpip',
                'pfr',
                'hours_played',
            ]);
    }
}
