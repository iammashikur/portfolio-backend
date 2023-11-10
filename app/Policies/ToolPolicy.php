<?php

namespace App\Policies;

use App\Models\Tool;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ToolPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the tool can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list tools');
    }

    /**
     * Determine whether the tool can view the model.
     */
    public function view(User $user, Tool $model): bool
    {
        return $user->hasPermissionTo('view tools');
    }

    /**
     * Determine whether the tool can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create tools');
    }

    /**
     * Determine whether the tool can update the model.
     */
    public function update(User $user, Tool $model): bool
    {
        return $user->hasPermissionTo('update tools');
    }

    /**
     * Determine whether the tool can delete the model.
     */
    public function delete(User $user, Tool $model): bool
    {
        return $user->hasPermissionTo('delete tools');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete tools');
    }

    /**
     * Determine whether the tool can restore the model.
     */
    public function restore(User $user, Tool $model): bool
    {
        return false;
    }

    /**
     * Determine whether the tool can permanently delete the model.
     */
    public function forceDelete(User $user, Tool $model): bool
    {
        return false;
    }
}
