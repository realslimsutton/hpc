<?php

namespace App\Filament\Resources\Club\ClubUpdateResource\Pages;

use App\Filament\Resources\Club\ClubUpdateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClubUpdate extends EditRecord
{
    protected static string $resource = ClubUpdateResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
