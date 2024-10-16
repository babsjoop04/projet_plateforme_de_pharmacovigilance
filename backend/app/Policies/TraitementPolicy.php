<?php

namespace App\Policies;

use App\Models\Traitement;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TraitementPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
        return  $user->role_utilisateur==="responsable_organisme_reglementation";
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Traitement $traitement)
    {
        //
        return $user->id === $traitement->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
        return $user->role_utilisateur==="responsable_organisme_reglementation";
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Traitement $traitement)
    {
        //
        return $user->id === $traitement->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Traitement $traitement)
    {
        //
        return false;
    }

    
}
