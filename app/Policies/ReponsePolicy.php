<?php

namespace App\Policies;

use App\Models\Interne;
use App\Models\Reponse;
use App\Models\User;

class ReponsePolicy
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
     * Determine whether the user can create models.
     */
    public function create(User $user, Interne $interne): bool
    {
        return $user->id === $interne->destinataire_id || $user->id === $interne->expediteur_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Reponse $reponse): bool
    {
        return $user->id === $reponse->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Reponse $reponse): bool
    {
        return $user->id === $reponse->user_id;
    }
}
