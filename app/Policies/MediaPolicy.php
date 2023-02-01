<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_media');
    }

    public function view(User $user): bool
    {
        return $user->can('view_media');
    }

    public function create(User $user): bool
    {
        return $user->can('create_media');
    }

    public function update(User $user): bool
    {
        return $user->can('update_media');
    }

    public function delete(User $user): bool
    {
        return $user->can('delete_media');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_media');
    }

    public function forceDelete(User $user): bool
    {
        return $user->can('force_delete_media');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_media');
    }

    public function restore(User $user): bool
    {
        return $user->can('restore_media');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_media');
    }

    public function replicate(User $user): bool
    {
        return $user->can('replicate_media');
    }

    public function reorder(User $user): bool
    {
        return $user->can('reorder_media');
    }
}
