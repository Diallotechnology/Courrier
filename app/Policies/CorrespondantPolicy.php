<?php

namespace App\Policies;

use App\Models\Correspondant;
use App\Models\User;

class CorrespondantPolicy
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
    public function view(User $user, Correspondant $correspondant): bool
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
    public function update(User $user, Correspondant $correspondant): bool
    {
        return $correspondant->structure_id === $user->structure();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Correspondant $correspondant): bool
    {
        return $correspondant->structure_id === $user->structure() && $user->isAdmin() || $user->isSuperuser();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Correspondant $correspondant): bool
    {
        return $correspondant->structure_id === $user->structure() && $user->isAdmin() || $user->isSuperuser();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Correspondant $correspondant): bool
    {
        return $correspondant->structure_id === $user->structure() && $user->isAdmin();
    }
}
