<?php

namespace App\Models\Club;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserClubUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'club_update_id',
        'agent_id',
        'games',
        'hands',
        'fee',
        'insurance',
        'net_winnings',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function club_update(): BelongsTo
    {
        return $this->belongsTo(ClubUpdate::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
