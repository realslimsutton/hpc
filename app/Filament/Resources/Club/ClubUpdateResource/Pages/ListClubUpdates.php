<?php

namespace App\Filament\Resources\Club\ClubUpdateResource\Pages;

use App\Filament\Resources\Club\ClubUpdateResource;
use App\Imports\ClubUpdateImport;
use App\Services\Club\ClubUpdateImportService;
use Carbon\Carbon;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ListClubUpdates extends ListRecords
{
    protected static string $resource = ClubUpdateResource::class;

    public function importClubUpdates(ClubUpdateImportService $clubUpdateService, array $data): void
    {
        $file = Storage::path($data['file']);

        rescue(
            static function () use ($clubUpdateService, $file) {
                $clubUpdateService->import($file);
                Notification::make()
                    ->success()
                    ->title('Successfully imported file')
                    ->send();
            },
            static fn() => Notification::make()
                ->danger()
                ->title('Failed to import file')
                ->send()
        );

        Storage::delete($data['file']);
    }

    protected function getActions(): array
    {
        return [
            Actions\Action::make('import')
                ->label('Import')
                ->icon('heroicon-o-upload')
                ->color('success')
                ->form([
                    FileUpload::make('file')
                        ->label('Files')
                        ->required()
                        ->disk('local')
                        ->directory('club-updates-tmp')
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                        ])
                ])
                ->action('importClubUpdates'),
            Actions\CreateAction::make(),
        ];
    }
}
