<?php

namespace App\Models;

use App\Models\Club\ClubRingGame;
use App\Models\Club\ClubUpdate;
use App\Models\Club\UserClubRingGame;
use App\Models\Club\UserClubUpdate;
use App\Models\Member\LoyaltyTier;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Squire\Models\Country;

class User extends Authenticatable implements MustVerifyEmail, FilamentUser, HasName
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'clubgg_id',
        'nickname',
        'balance',
        'loyalty_tier_id',
        'email',
        'email_verified_at',
        'password',
        'phone_number',
        'country_id',
        'accepts_marketing',
        'discord_id',
        'discord_username',
        'discord_token',
        'discord_refresh_token',
        'discord_discriminator',
        'discord_avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'balance' => 'integer',
    ];

    public function loyalty_tier(): BelongsTo
    {
        return $this->belongsTo(LoyaltyTier::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function club_updates_created(): HasMany
    {
        return $this->hasMany(ClubUpdate::class);
    }

    public function club_updates_agent(): HasMany
    {
        return $this->hasMany(UserClubUpdate::class, 'agent_id');
    }

    public function club_updates_participated(): HasMany
    {
        return $this->hasMany(UserClubUpdate::class);
    }

    public function club_ring_games_started(): HasMany
    {
        return $this->hasMany(ClubRingGame::class);
    }

    public function club_ring_games_participated(): HasMany
    {
        return $this->hasMany(UserClubRingGame::class);
    }

    public function getFilamentName(): string
    {
        return $this->full_name;
    }

    public function canAccessFilament(): bool
    {
        return $this->can('page_Dashboard');
    }
}
