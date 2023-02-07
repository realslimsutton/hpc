<?php

namespace App\Models\Club;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClubRingGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'started_at',
        'ended_at',
        'table_name',
        'user_id',
        'club_update_id',
        'game_rules',
        'blinds',
        'rake',
        'rake_cap'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function club_update(): BelongsTo
    {
        return $this->belongsTo(ClubUpdate::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(UserClubRingGame::class);
    }
}
