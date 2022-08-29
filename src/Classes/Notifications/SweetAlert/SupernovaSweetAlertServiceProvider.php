<?php

namespace Mohamadtsn\Supernova\Classes\Notifications\SweetAlert;

use Illuminate\Support\ServiceProvider;

class SupernovaSweetAlertServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../../../config/supernova-sweetalert.php',
            'sweetalert'
        );

        $this->app->singleton('supernova-sweetalert', function () {
            return new SweetAlert;
        });

        $this->app->alias('supernova-sweetalert', SweetAlert::class);
    }
}