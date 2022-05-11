<?php

namespace Mohamadtsn\Supernova\Classes\Traits;

use App\Models\User;
use Mohamadtsn\Supernova\Classes\MenuManagerService;
use Mohamadtsn\Supernova\Models\Role;

trait PermissionWrapper
{
    public function givePermissionTo(...$permissions)
    {
        $this->clearCachedMenu();
        return parent::givePermissionTo($permissions);
    }

    public function assignRole(...$roles)
    {
        $this->clearCachedMenu();
        return parent::assignRole($roles);
    }

    public function forgetCachedPermissions(): void
    {
        parent::forgetCachedPermissions();
        $this->clearCachedMenu();
    }

    /**
     * @return void
     */
    private function clearCachedMenu(): void
    {
        $instance = app(MenuManagerService::class);
        $instance->forgetCachedMenus();
        $this instanceof User && $instance->forgetCachedMenusForUsers($this);
        $this instanceof Role && $instance->forgetCachedMenusForUsersByRole($this);
    }
}
