<?php

namespace App\Filament\Resources\Tracker\GameRuleResource\Pages;

use App\Filament\Resources\Tracker\GameRuleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGameRule extends EditRecord
{
    protected static string $resource = GameRuleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
