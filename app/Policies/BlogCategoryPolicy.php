<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BlogCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the blogCategory can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list blogcategories');
    }

    /**
     * Determine whether the blogCategory can view the model.
     */
    public function view(User $user, BlogCategory $model): bool
    {
        return $user->hasPermissionTo('view blogcategories');
    }

    /**
     * Determine whether the blogCategory can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create blogcategories');
    }

    /**
     * Determine whether the blogCategory can update the model.
     */
    public function update(User $user, BlogCategory $model): bool
    {
        return $user->hasPermissionTo('update blogcategories');
    }

    /**
     * Determine whether the blogCategory can delete the model.
     */
    public function delete(User $user, BlogCategory $model): bool
    {
        return $user->hasPermissionTo('delete blogcategories');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete blogcategories');
    }

    /**
     * Determine whether the blogCategory can restore the model.
     */
    public function restore(User $user, BlogCategory $model): bool
    {
        return false;
    }

    /**
     * Determine whether the blogCategory can permanently delete the model.
     */
    public function forceDelete(User $user, BlogCategory $model): bool
    {
        return false;
    }
}
