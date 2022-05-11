<?php

namespace App\Http\Controllers\Panel;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Role\{StoreRequest, UpdateRequest};
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mohamadtsn\Supernova\Models\Role;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class RoleController extends Controller
{
    /**
     * @var RoleRepository|Application|mixed
     */
    private mixed $roleRepo;
    /**
     * @var PermissionRepository|Application|mixed
     */
    private mixed $permissionRepo;

    public function __construct()
    {
        $this->roleRepo = resolve(RoleRepository::class);
        $this->permissionRepo = resolve(PermissionRepository::class);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(Request $request)
    {
        $roles = $this->roleRepo->get();

        if ($request->get('name')) {
            $this->roleRepo->getLike($roles, $request);
        }

        $roles = $roles->get();

        return view('admin-panel.pages.roles.index', [
            'page_title' => 'نقش ها',
            'page_description' => ' - در این قسمت میتوانید نقش ها را مشاهده کنید',
            'roles' => $roles,
        ]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function show(Role $role)
    {
        $permissions = $this->permissionRepo->get();

        return view('admin-panel.pages.roles.show', [
            'permissions' => $permissions,
            'role' => $role,
            'page_title' => 'دسترسی ها',
            'page_description' => ' - در این قسمت میتوانید دسترسی های یک نقش را مشاهده کنید',
        ]);
    }

    /**
     * @param Role $role
     * @param UpdateRequest $request
     * @return RedirectResponse
     */
    public function update(Role $role, UpdateRequest $request): RedirectResponse
    {
        if ($role->name !== $request->get('title')) {
            $this->roleRepo->getValidate($request);
        }

        $permissions = $request->input('permissions');

        $this->roleRepo->getUpdate($role, $request);
        $this->roleRepo->getSyncPermissions($role, $permissions);

        alert()->success('عملیات موفق', 'عملیات با موفقیت انجام شد.');
        return back();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function create()
    {
        $permissions = $this->permissionRepo->get();

        return view('admin-panel.pages.roles.create', [
            'permissions' => $permissions,
            'page_title' => 'ایجاد نقش',
            'page_description' => ' - در این قسمت میتوانید نقش جدید اضافه کنید',
        ]);
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $permissions = $request->input('permissions');
        $role = $this->roleRepo->create($request);

        $this->roleRepo->syncPermissions($role, $permissions);

        toastr()->info('ایجاد نقش با موفقیت انجام شد.');

        return back();
    }
}
