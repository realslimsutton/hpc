<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'clubgg_id',
        'email',
        'email_verified_at',
        'password',
        'phone_number',
        'country',
        'accepts_marketing',
        'discord_id',
        'discord_username',
        'discord_token',
        'discord_refresh_token',
        'discord_discriminator',
        'discord_avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'datetime',
        'accepts_marketing' => 'bool',
    ];

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->first_name.' '.$this->last_name
        );
    }

    public function discordName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->discord_username.'#'.$this->discord_discriminator
        );
    }

    public function canAccessFilament(): bool
    {
        return $this->can('page_Dashboard');
    }

    public function getFilamentName(): string
    {
        return $this->full_name;
    }

    public function disconnectDiscord(): void
    {
        $this->forceFill([
            'discord_id' => null,
            'discord_username' => null,
            'discord_token' => null,
            'discord_refresh_token' => null,
            'discord_discriminator' => null,
            'discord_avatar' => null,
        ])->save();
    }
}
