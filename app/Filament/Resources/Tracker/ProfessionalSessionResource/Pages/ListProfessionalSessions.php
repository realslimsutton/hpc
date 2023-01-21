<?php

namespace App\Filament\Resources\Tracker\ProfessionalSessionResource\Pages;

use App\Filament\Resources\Tracker\ProfessionalSessionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfessionalSessions extends ListRecords
{
    protected static string $resource = ProfessionalSessionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
