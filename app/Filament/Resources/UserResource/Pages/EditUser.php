<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public function disconnectDiscord(): void
    {
        $this->getRecord()->disconnectDiscord();

        Notification::make()
            ->success()
            ->title('Discord has been disconnected')
            ->send();
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ActionGroup::make([
                Actions\Action::make('disconnect-discord')
                    ->label('Disconnect Discord')
                    ->color('danger')
                    ->icon('heroicon-o-x')
                    ->requiresConfirmation()
                    ->hidden(static fn (EditUser $livewire) => $livewire->getRecord()->discord_id === null)
                    ->action('disconnectDiscord'),
            ]),
        ];
    }
}
