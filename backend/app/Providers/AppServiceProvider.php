<?php

namespace App\Providers;

use App\Policies\NotificationPolicy;
use App\Policies\TraitementPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //notification
        Gate::define("create_eeim_pqif_notification",[NotificationPolicy::class, 'create_eeim_pqif'] );
        Gate::define("create_mapi_notification",[NotificationPolicy::class, 'create_mapi'] );
        Gate::define("view_notification",[NotificationPolicy::class, 'view'] );
        Gate::define("view_any_notification",[NotificationPolicy::class, 'viewAny'] );
        Gate::define("update_notification",[NotificationPolicy::class, 'update'] );
        Gate::define("delete_notification",[NotificationPolicy::class, 'delete'] );

    //traitement

        Gate::define("create_traitement",[TraitementPolicy::class, 'create'] );
        Gate::define("view_traitement",[TraitementPolicy::class, 'view'] );
        Gate::define("view_any_traitement",[TraitementPolicy::class, 'viewAny'] );
        Gate::define("update_traitement",[TraitementPolicy::class, 'update'] );
        Gate::define("delete_traitement",[TraitementPolicy::class, 'delete'] );

        //gestion utilisateur

        Gate::define("gestion_utilisateur",[UserPolicy::class, 'is_admin'] );





    }
}
