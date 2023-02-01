<?php

namespace App\Filament\Resources\Tracker\StakeResource\Pages;

use App\Filament\Resources\Tracker\StakeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStake extends EditRecord
{
    protected static string $resource = StakeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
