<?php

namespace App\Filament\Resources\Tracker\ProfessionalSessionResource\Pages;

use App\Filament\Resources\Tracker\ProfessionalSessionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Cache;

class EditProfessionalSession extends EditRecord
{
    protected static string $resource = ProfessionalSessionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
