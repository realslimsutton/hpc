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
        static::updating(static function(ProfessionalSession $model): void {
            Cache::forget('tracker.location.' . $model->location_id . '.rankings');
        });
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
