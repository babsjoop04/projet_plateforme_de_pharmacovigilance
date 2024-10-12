<?php

namespace App\Policies;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NotificationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role_utilisateur, ["administrateur","responsable_organisme_reglementation"]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Notification $notification): void
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role_utilisateur, ["consommateur","professionnel_sante","PRV_exploitant"]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Notification $notification): Response
    {
        //
        //
        return $user->id===$notification->user_id
        ?
        Response::allow() 
        : 
        Response::deny("vous n'etes pas proprietaire de cette notification");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Notification $notification): bool
    {
        //
        return false;
        // return $user->id===$notification->user_id
        // ?
        // Response::allow() 
        // : 
        // Response::deny("vous n'etes pas proprietaire de cette notification");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Notification $notification): void
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Notification $notification): bool
    {
        return false;
    }
}
