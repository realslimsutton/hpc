<?php

namespace App\Models\Club;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClubTournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'started_at',
        'ended_at',
        'table_name',
        'user_id',
        'club_update_id',
        'game_rules',
        'buy_in',
        'gtd_prize',
        're_entry'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        're_entry' => 'boolean'
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
        return $this->hasMany(UserClubTournament::class);
    }
}
