<?php

namespace App\Filament\Resources\Member\LoyaltyTierResource\Pages;

use App\Filament\Resources\Member\LoyaltyTierResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLoyaltyTier extends CreateRecord
{
    protected static string $resource = LoyaltyTierResource::class;
}
