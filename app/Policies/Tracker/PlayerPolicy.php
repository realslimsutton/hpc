<?php

namespace App\Policies\Tracker;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlayerPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_tracker::player');
    }

    public function view(User $user): bool
    {
        return $user->can('view_tracker::player');
    }

    public function create(User $user): bool
    {
        return $user->can('create_tracker::player');
    }

    public function update(User $user): bool
    {
        return $user->can('update_tracker::player');
    }

    public function delete(User $user): bool
    {
        return $user->can('delete_tracker::player');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_tracker::player');
    }

    public function forceDelete(User $user): bool
    {
        return $user->can('force_delete_tracker::player');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_tracker::player');
    }

    public function restore(User $user): bool
    {
        return $user->can('restore_tracker::player');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_tracker::player');
    }

    public function replicate(User $user): bool
    {
        return $user->can('replicate_tracker::player');
    }

    public function reorder(User $user): bool
    {
        return $user->can('reorder_tracker::player');
    }
}
