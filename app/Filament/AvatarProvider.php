<?php

namespace App\Filament;

use Filament\AvatarProviders\UiAvatarsProvider;
use Illuminate\Database\Eloquent\Model;

class AvatarProvider extends UiAvatarsProvider
{
    public function get(Model $user): string
    {
        return $user->discord_avatar ?? parent::get($user);
    }
}
