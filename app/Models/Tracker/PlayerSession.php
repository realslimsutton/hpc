<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PlayerSession extends Pivot
{
    protected $table = 'player_session';

    protected $fillable = [
        'player_id',
        'session_id',
        'net_winnings',
        'vpip',
        'pfr',
        'hours_played'
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }
}
