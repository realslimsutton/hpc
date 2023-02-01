<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
            ->withPivot([
                'id',
                'net_winnings',
                'vpip',
                'pfr',
                'hours_played',
            ]);
    }
}
