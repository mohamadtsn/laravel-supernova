<?php

namespace App\Http\Controllers\Panel;

use App\Repositories\ManagerRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\User\SetPermissionRequest;
use App\Http\Requests\Panel\User\SetRoleRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Mohamadtsn\Repository\Contracts\RepositoryProvisions;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @method ManagerRepository|PermissionRepository|RoleRepository repository(string $name = null)
 */
class UserController extends Controller implements RepositoryProvisions
{
    public function permissions(User $user)
    {
        $permissions = $this->repository('Permission')->get();
        $roles = $this->repository('Role')->get();
        return view('admin-panel.pages.users.permissions.show', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
            'page_title' => 'دسترسی کاربر',
            'page_description' => ' - در این قسمت میتوانید دسترسی های کاربر را مشاهده کنید.',
        ]);
    }

    public function setRoles(SetRoleRequest $request, User $user)
    {
        $this->repository('Manager')->getSyncRoles($user, $request);

        alert()?->success('عملیات موفق', 'اعطای نقش با موفقیت انجام شد.')->showConfirmButton('باشه', false);
        return back();
    }

    public function setPermissions(SetPermissionRequest $request, User $user)
    {
        $permissions = $request->input('permissions');
        $this->repository('Manager')->getSyncPermissions($user, $permissions);

        alert()?->success('عملیات موفق', 'ثبت دسترسی با موفقیت انجام شد.');

        return back();

    }

    public static function getName(): string
    {
        return 'User';
    }
}
