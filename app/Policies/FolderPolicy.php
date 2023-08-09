<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Folder;
use App\Models\Departement;
use App\Models\SubDepartement;
use Illuminate\Auth\Access\Response;

class FolderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Folder $folder): bool
    {
        if ($folder->IsCourrier()) {
            $query = $folder->folderable->imputations();
            if ($user->userable instanceof Departement) {
               $query->whereRelation('departements','id',$user->userable_id);
            } elseif($user->userable instanceof SubDepartement) {
                $query->whereRelation('subdepartements','id',$user->userable_id);
            }
            $query->exists();

            // check if user appartient aux departement ou subdepartemnt imputé
            $appartient = $query->exists();
            // check if user is imputation author
            $imp_author = $folder->folderable->imputations()->where('user_id',$user->id)->exists();

            return $user->id === $folder->user_id || $user->isAdmin() || $appartient || $imp_author;
        }

        if ($folder->IsInterne()) {
            return $user->isAdmin() || $user->id === $folder->folderable->destinataire_id || $user->id === $folder->folderable->expediteur_id;;
        }

        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Folder $folder): bool
    {
        if ($folder->IsCourrier()) {
            $query = $folder->folderable->imputations();
            if ($user->userable instanceof Departement) {
               $query->whereRelation('departements','id',$user->userable_id);
            } elseif($user->userable instanceof SubDepartement) {
                $query->whereRelation('subdepartements','id',$user->userable_id);
            }
            $query->exists();

            // check if user appartient aux departement ou subdepartemnt imputé
            $appartient = $query->exists();
            // check if user is imputation author
            $imp_author = $folder->folderable->imputations()->where('user_id',$user->id)->exists();

            return $user->id === $folder->user_id || $user->isAdmin() || $appartient || $imp_author;
        }

        if ($folder->IsInterne()) {
            return $user->isAdmin() || $user->id === $folder->folderable->destinataire_id || $user->id === $folder->folderable->expediteur_id;;
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Folder $folder): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Folder $folder): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Folder $folder): bool
    {
        //
    }
}
