<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'GET-/panel',
                'display_name' => 'داشبورد',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'GET-/panel/managers',
                'display_name' => 'لیست مدیران',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'DELETE-/panel/managers/{manager}',
                'display_name' => 'حذف مدیر',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'GET-/panel/users/{user}/permissions',
                'display_name' => 'فرم دسترسی کاربر',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'POST-/panel/users/{user}/permissions',
                'display_name' => 'دسترسی کاربر',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'POST-/panel/users/{user}/roles',
                'display_name' => 'نقش کاربر',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'GET-/panel/roles',
                'display_name' => 'لیست نقش ها',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'GET-/panel/roles/create',
                'display_name' => 'فرم ایجاد نقش',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'POST-/panel/roles',
                'display_name' => 'ایجاد نقش',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'GET-/panel/roles/{role}',
                'display_name' => 'فرم ویرایش نقش',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'PUT-/panel/roles/{role}',
                'display_name' => 'ویرایش نقش',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'GET-/panel/managers/create',
                'display_name' => 'فرم افزودن مدیر',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'POST-/panel/managers',
                'display_name' => 'افزودن مدیر',
                'guard_name' => 'admin',
            ],
        ]);
    }
}
