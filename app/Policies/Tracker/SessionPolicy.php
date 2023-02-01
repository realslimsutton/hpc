<?php

namespace App\Policies\Tracker;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SessionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_tracker::session');
    }

    public function view(User $user): bool
    {
        return $user->can('view_tracker::session');
    }

    public function create(User $user): bool
    {
        return $user->can('create_tracker::session');
    }

    public function update(User $user): bool
    {
        return $user->can('update_tracker::session');
    }

    public function delete(User $user): bool
    {
        return $user->can('delete_tracker::session');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_tracker::session');
    }

    public function forceDelete(User $user): bool
    {
        return $user->can('force_delete_tracker::session');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_tracker::session');
    }

    public function restore(User $user): bool
    {
        return $user->can('restore_tracker::session');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_tracker::session');
    }

    public function replicate(User $user): bool
    {
        return $user->can('replicate_tracker::session');
    }

    public function reorder(User $user): bool
    {
        return $user->can('reorder_tracker::session');
    }
}
