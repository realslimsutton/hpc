<?php

namespace App\Filament\Resources\System\UserResource\Pages;

use App\Filament\Resources\System\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $record = parent::handleRecordCreation($data);

        $record->syncRoles(
            Role::query()
                ->whereIn('id', $data['roles'] ?? [])
                ->get()
        );

        return $record;
    }
}
