<?php

namespace App\Models\Club;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserClubRingGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'club_ring_game_id',
        'buy_in',
        'hands',
        'rake',
        'insurance',
        'gross_winnings',
        'net_winnings'
    ];

    protected $casts = [
        'buy_in' => 'integer',
        'hands' => 'integer',
        'rake' => 'integer',
        'insurance' => 'integer',
        'gross_winnings' => 'integer',
        'net_winnings' => 'integer'
    ];

    public function club_ring_game(): BelongsTo
    {
        return $this->belongsTo(ClubRingGame::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
