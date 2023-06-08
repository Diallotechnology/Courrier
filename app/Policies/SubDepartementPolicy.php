<?php

namespace App\Policies;

use App\Models\SubDepartement;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubDepartementPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isSuperadmin()) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SubDepartement $subDepartement): bool
    {
        return $user->structure() === $subDepartement->departement->structure_id && $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can trash the model.
     */
    public function trash(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SubDepartement $subDepartement): bool
    {
        return $user->structure() === $subDepartement->departement->structure_id && $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SubDepartement $subDepartement): bool
    {
        return $user->structure() === $subDepartement->departement->structure_id && $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SubDepartement $subDepartement): bool
    {
        return $user->structure() === $subDepartement->departement->structure_id && $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SubDepartement $subDepartement): bool
    {
        return $user->structure() === $subDepartement->departement->structure_id && $user->isAdmin();
    }
}
