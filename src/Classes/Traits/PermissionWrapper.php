<?php

namespace Mohamadtsn\Supernova\Classes\Traits;

use App\Models\User;
use Mohamadtsn\Supernova\Classes\MenuManagerService;
use Spatie\Permission\Traits\HasRoles;

trait PermissionWrapper
{
    use HasRoles {
        givePermissionTo as givePermission;
        forgetCachedPermissions as forgetCachedPermission;
    }

    public function givePermissionTo(...$permissions)
    {
        $this->clearCachedMenu();
        return $this->givePermission($permissions);
    }

    public function forgetCachedPermissions(): void
    {
        $this->forgetCachedPermission();
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
    }
}
