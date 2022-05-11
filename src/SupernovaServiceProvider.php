<?php

namespace Mohamadtsn\Supernova;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Mohamadtsn\Supernova\Classes\MenuManagerService;
use Mohamadtsn\Supernova\Classes\Theme\Init;
use Mohamadtsn\Supernova\Classes\Theme\Menu;
use Mohamadtsn\Supernova\Classes\Theme\Supernova;
use Mohamadtsn\Supernova\Commands\PermissionSyncCommand;
use Mohamadtsn\Supernova\Commands\PublishCommand;

class SupernovaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerConfigs();
        $this->registerCommands();
        $this->registerFacades();
        $this->registerViews();

        $this->booted(function () {
            Init::run();
        });
    }

    public function boot(MenuManagerService $menuManager): void
    {
        $this->offerPublishing();

        $this->app->singleton(MenuManagerService::class, function ($app) use ($menuManager) {
            return $menuManager;
        });
    }

    protected function offerPublishing(): void
    {
        if (!function_exists('config_path')) {
            // function not available and 'publish' not relevant in `Lumen`
            return;
        }

        $this->publishBaseResource();

        $this->publishMigrations();

        $this->publishResources();

        $this->publishRoutes();

        $this->publishConfigs();
    }

    protected function registerCommands(): void
    {
        $this->commands([
            PublishCommand::class,
            PermissionSyncCommand::class,
            MenuCacheResetCommand::class,
        ]);
    }

    protected function getMigrationFileName($migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make($this->app->databasePath() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem, $migrationFileName) {
                return $filesystem->glob($path . '*_' . $migrationFileName);
            })
            ->push($this->app->databasePath() . "/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }

    private function publishRoutes(): void
    {
        $this->publishes([
            __DIR__ . '/../routes/administrator_without_virtual_host.php' => base_path('routes/admin.php'),
        ], 'supernova-basic-routes');

        $this->publishes([
            __DIR__ . '/../routes/administrator_with_virtual_host.php' => base_path('routes/admin.php'),
        ], 'supernova-virtual-host-routes');
    }

    private function publishConfigs(): void
    {
        $this->publishes([
            __DIR__ . '/../config/supernova.php' => config_path('supernova.php'),
            __DIR__ . '/../config/permission.php' => config_path('permission.php'),
        ], 'supernova-config');
    }

    private function publishMigrations(): void
    {
        $this->publishes([
            __DIR__ . '/../database/migrations/create_permission_tables.php.stub' => $this->getMigrationFileName('create_permission_tables.php'),
            __DIR__ . '/../database/migrations/add_field_to_users.php.stub' => $this->getMigrationFileName('add_field_to_users.php'),
            __DIR__ . '/../database/seeders' => base_path('database/seeders'),
        ], 'supernova-migrations');
    }

    private function registerConfigs(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/supernova.php',
            'supernova'
        );
        $this->mergeConfigFrom(
            __DIR__ . '/../config/permission.php',
            'permission'
        );
    }

    private function publishResources(): void
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/admin-panel/'),
            __DIR__ . '/../resources/assets' => base_path('public/panel/'),
            __DIR__ . '/../resources/admin-panel' => base_path('resources/js/admin-panel/'),
        ], 'supernova-resources');
    }

    private function publishBaseResource(): void
    {
        $this->publishes([
            __DIR__ . '/Http/Controllers' => base_path('app/Http/Controllers/Panel/'),
            __DIR__ . '/Http/Middleware' => base_path('app/Http/Middleware/'),
            __DIR__ . '/Http/Requests' => base_path('app/Http/Requests/Panel/'),
            __DIR__ . '/../lang' => base_path('lang/fa'),
            __DIR__ . '/Models/User.php' => base_path('app/Models/'),
            __DIR__ . '/Repositories' => base_path('app/Repositories/'),
        ], 'supernova-base-resources');
    }

    private function registerFacades(): void
    {
        $this->app->singleton('supernova', Supernova::class);
        $this->app->singleton('menu', Menu::class);
    }

    private function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/vendor', 'supernova');
    }
}