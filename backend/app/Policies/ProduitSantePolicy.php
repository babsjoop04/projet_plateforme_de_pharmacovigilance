<?php

namespace App\Policies;

use App\Models\Produit_sante;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProduitSantePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): void
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Produit_sante $produitSante): void
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): void 
    {
        // 
        
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Produit_sante $produitSante): void
    {
        //
        
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Produit_sante $produitSante): void
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Produit_sante $produitSante): void
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Produit_sante $produitSante): void
    {
        //
    }
}
