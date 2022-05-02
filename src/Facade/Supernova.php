<?php

namespace Mohamadtsn\Supernova\Facade;

use Illuminate\Support\Facades\Facade;

class Supernova extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'supernova';
    }
}