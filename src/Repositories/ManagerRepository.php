<?php

namespace App\Repositories;

use App\Http\Requests\Panel\User\SetRoleRequest;
use App\Http\Requests\Panel\User\StoreRequest;
use App\Models\User;

class ManagerRepository
{
    public function getAll()
    {
        return User::where('level', '<', 4)->get();
    }

    public function get($users): mixed
    {
        return $users->get();
    }

    public function getSyncRoles(User $user, SetRoleRequest $request): void
    {
        $user->syncRoles((array)$request->get('role'));
    }

    public function getSyncPermissions(User $user, $permissions): void
    {
        $user->syncPermissions($permissions);
    }

    public function delete(User $manager): void
    {
        $manager->delete();
    }

    public function userCreate(StoreRequest $request): void
    {
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'level' => '1',
        ]);
    }
}
