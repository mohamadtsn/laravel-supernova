<?php

namespace App\Http\Controllers\Panel;

use App\Repositories\ManagerRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\User\StoreRequest;
use App\Models\User;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Mohamadtsn\Repository\Contracts\RepositoryProvisions;

/**
 * @method ManagerRepository|PermissionRepository|RoleRepository repository(string $name = null)
 */
class ManagerController extends Controller implements RepositoryProvisions
{
    public function index(Request $request)
    {
        $users = $this->repository()->getAll();

        return view('admin-panel.pages.users.managers.index', [
            'page_description' => 'در این قسمت میتوانید لیست مدیران را مشاهده کنید',
            'page_title' => 'لیست مدیران',
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('admin-panel.pages.users.managers.create', [
            'page_description' => 'در این قسمت میتوانید یک مدیر جدید ایجاد کنید.',
            'page_title' => 'ایجاد مدیر جدید',
        ]);
    }

    public function store(StoreRequest $request)
    {
        $this->repository()->userCreate($request);

        alert()?->success('عملیات موفق', 'مدیر جدید با موفقیت اضافه شد.')->showConfirmButton('باشه', false);
        return redirect()->route('panel.managers.index');
    }

    public function destroy(User $manager)
    {
        $this->repository()->delete($manager);

        alert()?->success('عملیات موفق', 'مدیریت با موفقیت حذف شد!')->showConfirmButton('باشه', false);
        return back();
    }

    public static function getName(): string
    {
        return 'Manager';
    }
}
