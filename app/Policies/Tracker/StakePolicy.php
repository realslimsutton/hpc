<?php

namespace App\Policies\Tracker;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StakePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_tracker::stake');
    }

    public function view(User $user): bool
    {
        return $user->can('view_tracker::stake');
    }

    public function create(User $user): bool
    {
        return $user->can('create_tracker::stake');
    }

    public function update(User $user): bool
    {
        return $user->can('update_tracker::stake');
    }

    public function delete(User $user): bool
    {
        return $user->can('delete_tracker::stake');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_tracker::stake');
    }

    public function forceDelete(User $user): bool
    {
        return $user->can('force_delete_tracker::stake');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_tracker::stake');
    }

    public function restore(User $user): bool
    {
        return $user->can('restore_tracker::stake');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_tracker::stake');
    }

    public function replicate(User $user): bool
    {
        return $user->can('replicate_tracker::stake');
    }

    public function reorder(User $user): bool
    {
        return $user->can('reorder_tracker::stake');
    }
}
