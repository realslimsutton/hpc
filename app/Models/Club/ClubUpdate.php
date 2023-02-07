<?php

namespace App\Models\Club;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClubUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'user_id'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(UserClubUpdate::class);
    }

    public function ring_games(): HasMany
    {
        return $this->hasMany(ClubRingGame::class);
    }

    public function tournaments(): HasMany
    {
        return $this->hasMany(ClubTournament::class);
    }
}
