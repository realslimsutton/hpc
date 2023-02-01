<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, FilamentUser, HasName
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'clubgg_id',
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
    ];

    public function getFilamentName(): string
    {
        return $this->full_name;
    }

    public function canAccessFilament(): bool
    {
        return $this->can('page_Dashboard');
    }

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->first_name.' '.$this->last_name
        );
    }
}
