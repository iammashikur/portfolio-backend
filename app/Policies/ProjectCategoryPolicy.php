<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProjectCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the projectCategory can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list projectcategories');
    }

    /**
     * Determine whether the projectCategory can view the model.
     */
    public function view(User $user, ProjectCategory $model): bool
    {
        return $user->hasPermissionTo('view projectcategories');
    }

    /**
     * Determine whether the projectCategory can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create projectcategories');
    }

    /**
     * Determine whether the projectCategory can update the model.
     */
    public function update(User $user, ProjectCategory $model): bool
    {
        return $user->hasPermissionTo('update projectcategories');
    }

    /**
     * Determine whether the projectCategory can delete the model.
     */
    public function delete(User $user, ProjectCategory $model): bool
    {
        return $user->hasPermissionTo('delete projectcategories');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete projectcategories');
    }

    /**
     * Determine whether the projectCategory can restore the model.
     */
    public function restore(User $user, ProjectCategory $model): bool
    {
        return false;
    }

    /**
     * Determine whether the projectCategory can permanently delete the model.
     */
    public function forceDelete(User $user, ProjectCategory $model): bool
    {
        return false;
    }
}
