<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    /**
     * @return Collection|Permission[]
     */
    public function get()
    {
        return Permission::all();
    }
}
