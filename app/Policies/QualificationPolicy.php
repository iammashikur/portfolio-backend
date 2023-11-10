<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Qualification;
use Illuminate\Auth\Access\HandlesAuthorization;

class QualificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the qualification can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list qualifications');
    }

    /**
     * Determine whether the qualification can view the model.
     */
    public function view(User $user, Qualification $model): bool
    {
        return $user->hasPermissionTo('view qualifications');
    }

    /**
     * Determine whether the qualification can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create qualifications');
    }

    /**
     * Determine whether the qualification can update the model.
     */
    public function update(User $user, Qualification $model): bool
    {
        return $user->hasPermissionTo('update qualifications');
    }

    /**
     * Determine whether the qualification can delete the model.
     */
    public function delete(User $user, Qualification $model): bool
    {
        return $user->hasPermissionTo('delete qualifications');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete qualifications');
    }

    /**
     * Determine whether the qualification can restore the model.
     */
    public function restore(User $user, Qualification $model): bool
    {
        return false;
    }

    /**
     * Determine whether the qualification can permanently delete the model.
     */
    public function forceDelete(User $user, Qualification $model): bool
    {
        return false;
    }
}
