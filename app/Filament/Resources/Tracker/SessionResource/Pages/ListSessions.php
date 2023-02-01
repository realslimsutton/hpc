<?php

namespace App\Filament\Resources\Tracker\SessionResource\Pages;

use App\Filament\Resources\Tracker\SessionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSessions extends ListRecords
{
    protected static string $resource = SessionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
