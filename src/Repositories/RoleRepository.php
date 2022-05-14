<?php


namespace App\Repositories;


use App\Http\Requests\Panel\Role\StoreRequest;
use App\Http\Requests\Panel\Role\UpdateRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Mohamadtsn\Supernova\Models\Role;

class RoleRepository
{
    /**
     * @return Collection|Role[]
     */
    public function get()
    {
        return Role::all();
    }

    /**
     * @param UpdateRequest $request
     */
    public function getValidate(UpdateRequest $request): void
    {
        $request->validate([
            'title' => 'unique:roles,name',
        ]);
    }

    /**
     * @param Role $role
     * @param UpdateRequest $request
     */
    public function getUpdate(Role $role, UpdateRequest $request): void
    {
        $role->update([
            'name' => $request->get('title')
        ]);
    }

    /**
     * @param Role $role
     * @param $permissions
     */
    public function getSyncPermissions(Role $role, $permissions): void
    {
        $role->syncPermissions($permissions);
    }

    /**
     * @param Builder $roles
     * @param Request $request
     */
    public function getLike(Builder $roles, Request $request): void
    {
        $roles->where('name', 'like', '%' . $request->get('name') . '%');
    }

    /**
     * @param StoreRequest $request
     * @return Builder|Model
     */
    public function create(StoreRequest $request): Model|Builder
    {
        return Role::create([
            'name' => $request->get('title'),
        ]);
    }

    /**
     * @param Role $role
     * @param $permissions
     */
    public function syncPermissions(Role $role, $permissions): void
    {
        $role->syncPermissions($permissions);
    }
}
