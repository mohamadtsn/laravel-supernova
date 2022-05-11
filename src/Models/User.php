<?php

namespace Mohamadtsn\Supernova\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    public function guardName(): string
    {
        return config('supernova.default_guard');
    }
}