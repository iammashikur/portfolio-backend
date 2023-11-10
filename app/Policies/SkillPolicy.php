<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Skill;
use Illuminate\Auth\Access\HandlesAuthorization;

class SkillPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the skill can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list skills');
    }

    /**
     * Determine whether the skill can view the model.
     */
    public function view(User $user, Skill $model): bool
    {
        return $user->hasPermissionTo('view skills');
    }

    /**
     * Determine whether the skill can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create skills');
    }

    /**
     * Determine whether the skill can update the model.
     */
    public function update(User $user, Skill $model): bool
    {
        return $user->hasPermissionTo('update skills');
    }

    /**
     * Determine whether the skill can delete the model.
     */
    public function delete(User $user, Skill $model): bool
    {
        return $user->hasPermissionTo('delete skills');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete skills');
    }

    /**
     * Determine whether the skill can restore the model.
     */
    public function restore(User $user, Skill $model): bool
    {
        return false;
    }

    /**
     * Determine whether the skill can permanently delete the model.
     */
    public function forceDelete(User $user, Skill $model): bool
    {
        return false;
    }
}
