<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestimonialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the testimonial can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list testimonials');
    }

    /**
     * Determine whether the testimonial can view the model.
     */
    public function view(User $user, Testimonial $model): bool
    {
        return $user->hasPermissionTo('view testimonials');
    }

    /**
     * Determine whether the testimonial can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create testimonials');
    }

    /**
     * Determine whether the testimonial can update the model.
     */
    public function update(User $user, Testimonial $model): bool
    {
        return $user->hasPermissionTo('update testimonials');
    }

    /**
     * Determine whether the testimonial can delete the model.
     */
    public function delete(User $user, Testimonial $model): bool
    {
        return $user->hasPermissionTo('delete testimonials');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete testimonials');
    }

    /**
     * Determine whether the testimonial can restore the model.
     */
    public function restore(User $user, Testimonial $model): bool
    {
        return false;
    }

    /**
     * Determine whether the testimonial can permanently delete the model.
     */
    public function forceDelete(User $user, Testimonial $model): bool
    {
        return false;
    }
}
