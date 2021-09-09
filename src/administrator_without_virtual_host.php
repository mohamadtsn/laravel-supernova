<?php
/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\AuthController;
use App\Http\Controllers\Panel\ManagerController;
use App\Http\Controllers\Panel\RoleController;

Route::prefix('panel')->middleware('web')->as('panel.')->group(function () {

    //login & logout
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login_view');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    //authenticated user can
    Route::middleware(['auth:admin', 'permission'])->group(function () {
        //Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        //managers
        Route::resource('managers', ManagerController::class)->except(['edit', 'update', 'show']);


        Route::prefix('users')->as('users.')->group(function () {

            //permissions
            Route::get('{user}/permissions', [UserController::class, 'permissions'])->name('permissions');
            Route::post('{user}/permissions', [UserController::class, 'setPermissions'])->name('store.permissions');

            //roles
            Route::post('{user}/roles', [UserController::class, 'setRoles'])->name('store.roles');

        });

        //roles
        Route::resource('roles', RoleController::class)->except(['destroy', 'edit']);
    });

});