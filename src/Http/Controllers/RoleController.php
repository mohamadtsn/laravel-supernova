<?php

namespace App\Http\Controllers\Panel;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Http\Controllers\Controller;
use Mohamadtsn\Repository\Contracts\RepositoryProvisions;
use App\Http\Requests\Panel\Role\{
    StoreRequest,
    UpdateRequest};
use Illuminate\Http\RedirectResponse;
use Mohamadtsn\Supernova\Models\Role;

/**
 * @method PermissionRepository|RoleRepository repository(string $name = null)
 */
class RoleController extends Controller implements RepositoryProvisions
{
    public function index()
    {
        $roles = $this->repository()->get();

        return view('admin-panel.pages.roles.index', [
            'page_title' => 'نقش ها',
            'page_description' => 'در این قسمت میتوانید نقش ها را مشاهده کنید.',
            'roles' => $roles,
        ]);
    }

    public function show(Role $role)
    {
        $permissions = $this->repository('Permission')->get();

        return view('admin-panel.pages.roles.show', [
            'permissions' => $permissions,
            'role' => $role,
            'page_title' => 'دسترسی ها',
            'page_description' => 'در این قسمت میتوانید دسترسی های یک نقش را مشاهده کنید.',
        ]);
    }

    public function update(Role $role, UpdateRequest $request): RedirectResponse
    {
        if ($role->name !== $request->get('title')) {
            $this->repository()->getValidate($request);
        }

        if (auth()->user()?->hasRole($role)) {
            alert()->error('توقف عملیات', 'شما مجاز به انجام این عملیات نیستید.')->showConfirmButton('باشه', false);
            return back();
        }

        $permissions = $request->input('permissions');

        $this->repository()->getUpdate($role, $request);
        $this->repository()->getSyncPermissions($role, $permissions);

        alert()->success('عملیات موفق', "نقش \"$role->name\" با موفقیت ویرایش شد.")->showConfirmButton('باشه', false);
        return back();
    }

    public function create()
    {
        $permissions = $this->repository('Permission')->get();

        return view('admin-panel.pages.roles.create', [
            'permissions' => $permissions,
            'page_title' => 'ایجاد نقش',
            'page_description' => 'در این قسمت میتوانید نقش جدید اضافه کنید.',
        ]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $permissions = $request->input('permissions');
        $role = $this->repository()->create($request);

        $this->repository()->syncPermissions($role, $permissions);

        alert()->success('عملیات موفق', 'ایجاد نقش با موفقیت انجام شد.')->showConfirmButton('باشه', false);

        return redirect()->route('panel.roles.index');
    }

    public static function getName(): string
    {
        return 'Role';
    }
}
