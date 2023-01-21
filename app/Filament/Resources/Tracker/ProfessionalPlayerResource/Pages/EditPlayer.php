<?php

namespace App\Filament\Resources\Tracker\ProfessionalPlayerResource\Pages;

use App\Filament\Resources\Tracker\ProfessionalPlayerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlayer extends EditRecord
{
    protected static string $resource = ProfessionalPlayerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
