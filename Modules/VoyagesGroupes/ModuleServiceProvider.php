<?php

namespace Modules\VoyagesGroupes;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Enregistre les routes, vues, migrations du module
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'voyagesgroupes');
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
    }

    public function boot()
    {
        //
    }
}
