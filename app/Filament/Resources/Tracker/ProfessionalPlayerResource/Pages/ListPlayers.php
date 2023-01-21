<?php

namespace App\Filament\Resources\Tracker\ProfessionalPlayerResource\Pages;

use App\Filament\Resources\Tracker\ProfessionalPlayerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlayers extends ListRecords
{
    protected static string $resource = ProfessionalPlayerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
