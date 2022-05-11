<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Mohamadtsn\Supernova\Models\Permission;

class PermissionRepository
{
    /**
     * @return Collection|Permission[]
     */
    public function get(): Collection|array
    {
        return Permission::all();
    }
}
