<?php

namespace App\Policies;

use App\Models\Courrier;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CourrierPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isSuperadmin()) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Courrier $courrier): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

        /**
     * Determine whether the user can trash the model.
     */
    public function trash(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Courrier $courrier): bool
    {
        return ($user->isAdmin() || $user->isSuperuser() || $user->isStandard()) &&
            $user->id === $courrier->user_id &&
           ! $courrier->Archive();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Courrier $courrier): bool
    {
        return $user->structure() === $courrier->structure_id &&
            ($user->isAdmin() || $user->isSuperuser() || $user->isStandard()) &&
            $user->id === $courrier->user_id &&
            $courrier->Register();
    }


    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Courrier $courrier): bool
    {
        return $user->structure() === $courrier->structure_id && ($user->isAdmin() || $user->isSuperuser());
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Courrier $courrier): bool
    {
       return $user->structure() === $courrier->structure_id && $user->isAdmin();
    }
}
