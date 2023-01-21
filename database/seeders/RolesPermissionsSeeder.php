<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesPermissionsSeeder extends Seeder
{
    private array $permissions = [
        'view_role',
        'view_any_role',
        'create_role',
        'update_role',
        'delete_role',
        'delete_any_role',

        'view_user',
        'view_any_user',
        'create_user',
        'update_user',
        'delete_user',
        'delete_any_user',
    ];

    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = collect($this->permissions)
            ->map(static fn ($permission): array => [
                'name' => $permission,
                'guard_name' => 'web',
            ])
            ->all();

        Permission::query()->insert($permissions);

        Role::create(['name' => 'administrator'])
            ->givePermissionTo($this->permissions);
    }
}
