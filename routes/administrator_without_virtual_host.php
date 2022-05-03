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
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'loginPage')->name('login_view');
        Route::post('/login', 'login')->name('login');
        Route::get('/logout', 'logout')->name('logout');
    });

    // authenticated user can
    Route::middleware(['auth:admin', 'permission'])->group(function () {

        //Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        //managers
        Route::resource('managers', ManagerController::class)->except(['edit', 'update', 'show']);

        Route::group(['as' => 'users.', 'prefix' => 'users'], static function () {
            // user-permissions
            Route::controller(UserController::class)->group(function () {
                Route::get('{user}/permissions', 'permissions')->name('permissions');
                Route::post('{user}/permissions', 'setPermissions')->name('store.permissions');

                // user-roles
                Route::post('{user}/roles', 'setRoles')->name('store.roles');
            });
        });

        //roles
        Route::resource('roles', RoleController::class)->except(['destroy', 'edit']);
    });

});