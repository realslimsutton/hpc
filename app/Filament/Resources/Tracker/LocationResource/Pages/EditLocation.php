<?php

namespace App\Filament\Resources\Tracker\LocationResource\Pages;

use App\Filament\Resources\Tracker\LocationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLocation extends EditRecord
{
    protected static string $resource = LocationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
