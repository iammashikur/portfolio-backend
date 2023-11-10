<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BlogComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the blogComment can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list blogcomments');
    }

    /**
     * Determine whether the blogComment can view the model.
     */
    public function view(User $user, BlogComment $model): bool
    {
        return $user->hasPermissionTo('view blogcomments');
    }

    /**
     * Determine whether the blogComment can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create blogcomments');
    }

    /**
     * Determine whether the blogComment can update the model.
     */
    public function update(User $user, BlogComment $model): bool
    {
        return $user->hasPermissionTo('update blogcomments');
    }

    /**
     * Determine whether the blogComment can delete the model.
     */
    public function delete(User $user, BlogComment $model): bool
    {
        return $user->hasPermissionTo('delete blogcomments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete blogcomments');
    }

    /**
     * Determine whether the blogComment can restore the model.
     */
    public function restore(User $user, BlogComment $model): bool
    {
        return false;
    }

    /**
     * Determine whether the blogComment can permanently delete the model.
     */
    public function forceDelete(User $user, BlogComment $model): bool
    {
        return false;
    }
}
