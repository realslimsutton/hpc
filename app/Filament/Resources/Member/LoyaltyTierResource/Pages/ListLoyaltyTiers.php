<?php

namespace App\Filament\Resources\Member\LoyaltyTierResource\Pages;

use App\Filament\Resources\Member\LoyaltyTierResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLoyaltyTiers extends ListRecords
{
    protected static string $resource = LoyaltyTierResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
