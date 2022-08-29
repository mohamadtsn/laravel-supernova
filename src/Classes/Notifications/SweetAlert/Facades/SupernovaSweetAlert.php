<?php

namespace Mohamadtsn\Supernova\Classes\Notifications\SweetAlert\Facades;

use Illuminate\Support\Facades\Facade;

class SupernovaSweetAlert extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'supernova-sweetalert';
    }
}
