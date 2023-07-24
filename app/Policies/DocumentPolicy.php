<?php

namespace App\Policies;

use App\Models\Departement;
use App\Models\Document;
use App\Models\SubDepartement;
use App\Models\User;

class DocumentPolicy
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
    public function view(User $user, Document $document): bool
    {
        if ($document->IsCourrier()) {
            // $document->documentable->Register()
            $query = $document->documentable->imputations();
            if ($user->userable instanceof Departement) {
               $query->whereRelation('departements','id',$user->userable_id);
            } elseif($user->userable instanceof SubDepartement) {
                $query->whereRelation('subdepartements','id',$user->userable_id);
            }
            $query->exists();

            // check if user appartient aux departement ou subdepartemnt imputé
            $appartient = $query->exists();
            // check if user is imputation author
            $imp_author = $document->documentable->imputations()->where('user_id',$user->id)->exists();

            return $user->id === $document->user_id || $user->isAdmin() || ($user->isSuperuser() and $document->documentable);
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can download file the model.
     */
    public function download(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can trash the model.
     */
    public function trash(User $user): bool
    {
        return $user->isAdmin() || $user->isSuperuser();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Document $document): bool
    {
        return $user->isAdmin() || $user->isSuperuser() || $user->id === $document->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Document $document): bool
    {
        return $user->isAdmin() || $user->isSuperuser() && $user->id === $document->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Document $document): bool
    {
        return $user->isAdmin() || $user->isSuperuser() || $user->id === $document->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Document $document): bool
    {
        return $user->isAdmin() || $user->isSuperuser();
    }
}
