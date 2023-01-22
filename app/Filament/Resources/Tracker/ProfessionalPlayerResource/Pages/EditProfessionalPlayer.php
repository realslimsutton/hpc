<?php

namespace App\Filament\Resources\Tracker\ProfessionalPlayerResource\Pages;

use App\Filament\Resources\Tracker\ProfessionalPlayerResource;
use App\Models\Tracker\Location;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Cache;

class EditProfessionalPlayer extends EditRecord
{
    protected static string $resource = ProfessionalPlayerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
