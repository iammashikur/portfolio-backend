<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SocialLink;
use Illuminate\Auth\Access\HandlesAuthorization;

class SocialLinkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the socialLink can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list sociallinks');
    }

    /**
     * Determine whether the socialLink can view the model.
     */
    public function view(User $user, SocialLink $model): bool
    {
        return $user->hasPermissionTo('view sociallinks');
    }

    /**
     * Determine whether the socialLink can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create sociallinks');
    }

    /**
     * Determine whether the socialLink can update the model.
     */
    public function update(User $user, SocialLink $model): bool
    {
        return $user->hasPermissionTo('update sociallinks');
    }

    /**
     * Determine whether the socialLink can delete the model.
     */
    public function delete(User $user, SocialLink $model): bool
    {
        return $user->hasPermissionTo('delete sociallinks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete sociallinks');
    }

    /**
     * Determine whether the socialLink can restore the model.
     */
    public function restore(User $user, SocialLink $model): bool
    {
        return false;
    }

    /**
     * Determine whether the socialLink can permanently delete the model.
     */
    public function forceDelete(User $user, SocialLink $model): bool
    {
        return false;
    }
}
