<?php

namespace Mohamadtsn\Supernova\Classes\Notifications\Toaster\Facades;

use Illuminate\Support\Facades\Facade;

class SupernovaToaster extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'supernova-toaster';
    }
}
