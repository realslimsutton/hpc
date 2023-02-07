<?php

namespace App\Models\Club;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserClubTournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'club_tournament_id',
        'buy_in',
        'buy_in_fee',
        're_entry',
        're_entry_fee',
        'hands',
        'gross_winnings',
        'net_winnings'
    ];

    protected $casts = [
        'buy_in' => 'integer',
        'buy_in_fee' => 'integer',
        're_entry' => 'integer',
        're_entry_fee' => 'integer',
        'hands' => 'integer',
        'gross_winnings' => 'integer',
        'net_winnings' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function club_tournament(): BelongsTo
    {
        return $this->belongsTo(ClubTournament::class);
    }
}
