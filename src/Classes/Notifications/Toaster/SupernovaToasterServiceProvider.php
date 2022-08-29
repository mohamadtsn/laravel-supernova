<?php

namespace Mohamadtsn\Supernova\Classes\Notifications\Toaster;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class SupernovaToasterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../../../config/supernova-toaster.php',
            'toastr'
        );

        $this->app->singleton('supernova-toaster', function (Container $app) {
            return new Toaster($app['session'], $app['config']);
        });

        $this->app->alias('supernova-toaster', Toaster::class);
    }
}