<?php

namespace App\Policies;

use App\Models\Imputation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ImputationPolicy
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
    public function view(User $user, Imputation $imputation): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isSuperuser() || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Imputation $imputation): bool
    {
        return $user->isAdmin() || $user->isSuperuser() && $user->id === $imputation->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Imputation $imputation): bool
    {
        return $user->isAdmin() || $user->isSuperuser() && $user->id === $imputation->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Imputation $imputation): bool
    {
        return $user->isAdmin() || $user->isSuperuser() && $user->id === $imputation->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Imputation $imputation): bool
    {
        return $user->isAdmin() || $user->isSuperuser() && $user->id === $imputation->user_id;
    }
}
