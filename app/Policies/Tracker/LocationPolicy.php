<?php

namespace App\Policies\Tracker;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_tracker::location');
    }

    public function view(User $user): bool
    {
        return $user->can('view_tracker::location');
    }

    public function create(User $user): bool
    {
        return $user->can('create_tracker::location');
    }

    public function update(User $user): bool
    {
        return $user->can('update_tracker::location');
    }

    public function delete(User $user): bool
    {
        return $user->can('delete_tracker::location');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_tracker::location');
    }

    public function forceDelete(User $user): bool
    {
        return $user->can('force_delete_tracker::location');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_tracker::location');
    }

    public function restore(User $user): bool
    {
        return $user->can('restore_tracker::location');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_tracker::location');
    }

    public function replicate(User $user): bool
    {
        return $user->can('replicate_tracker::location');
    }

    public function reorder(User $user): bool
    {
        return $user->can('reorder_tracker::location');
    }
}
