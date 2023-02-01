<?php

namespace App\Filament\Resources\Tracker\PlayerResource\Pages;

use App\Filament\Resources\Tracker\PlayerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlayer extends EditRecord
{
    protected static string $resource = PlayerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
