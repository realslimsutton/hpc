<?php

namespace App\Policies\Tracker;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GameRulePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_tracker::game::rule');
    }

    public function view(User $user): bool
    {
        return $user->can('view_tracker::game::rule');
    }

    public function create(User $user): bool
    {
        return $user->can('create_tracker::game::rule');
    }

    public function update(User $user): bool
    {
        return $user->can('update_tracker::game::rule');
    }

    public function delete(User $user): bool
    {
        return $user->can('delete_tracker::game::rule');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_tracker::game::rule');
    }

    public function forceDelete(User $user): bool
    {
        return $user->can('force_delete_tracker::game::rule');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_tracker::game::rule');
    }

    public function restore(User $user): bool
    {
        return $user->can('restore_tracker::game::rule');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_tracker::game::rule');
    }

    public function replicate(User $user): bool
    {
        return $user->can('replicate_tracker::game::rule');
    }

    public function reorder(User $user): bool
    {
        return $user->can('reorder_tracker::game::rule');
    }
}
