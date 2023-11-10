<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Experience;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExperiencePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the experience can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list experiences');
    }

    /**
     * Determine whether the experience can view the model.
     */
    public function view(User $user, Experience $model): bool
    {
        return $user->hasPermissionTo('view experiences');
    }

    /**
     * Determine whether the experience can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create experiences');
    }

    /**
     * Determine whether the experience can update the model.
     */
    public function update(User $user, Experience $model): bool
    {
        return $user->hasPermissionTo('update experiences');
    }

    /**
     * Determine whether the experience can delete the model.
     */
    public function delete(User $user, Experience $model): bool
    {
        return $user->hasPermissionTo('delete experiences');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete experiences');
    }

    /**
     * Determine whether the experience can restore the model.
     */
    public function restore(User $user, Experience $model): bool
    {
        return false;
    }

    /**
     * Determine whether the experience can permanently delete the model.
     */
    public function forceDelete(User $user, Experience $model): bool
    {
        return false;
    }
}
