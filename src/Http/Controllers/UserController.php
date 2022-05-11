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
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class UserController extends Controller
{
    /**
     * @var PermissionRepository|Application|mixed
     */
    private mixed $permissionRepo;
    /**
     * @var RoleRepository|Application|mixed
     */
    private mixed $roleRepo;
    /**
     * @var ManagerRepository|Application|mixed
     */
    private mixed $managerRepo;

    public function __construct()
    {
        $this->permissionRepo = resolve(PermissionRepository::class);
        $this->roleRepo = resolve(RoleRepository::class);
        $this->managerRepo = resolve(ManagerRepository::class);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function permissions(User $user)
    {
        $permissions = $this->permissionRepo->get();
        $roles = $this->roleRepo->get()->get();
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
        $this->managerRepo->getSyncRoles($user, $request);

        toastr()->success('اعطای نقش با موفقیت انجام شد.');
        return back();
    }

    public function setPermissions(SetPermissionRequest $request, User $user)
    {
        $permissions = $request->input('permissions');
        $this->managerRepo->getSyncPermissions($user, $permissions);

        toastr()->success('ثبت دسترسی با موفقیت انجام شد.');

        return back();

    }
}
