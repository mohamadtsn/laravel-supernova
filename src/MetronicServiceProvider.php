<?php

namespace Mohamadtsn\Supernova;

use Illuminate\Support\ServiceProvider;

class MetronicServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/controllers' => base_path('app/Http/Controllers/Panel/'),
            __DIR__ . '/middleware' => base_path('app/Http/Middleware/Panel/'),
            __DIR__ . '/requests' => base_path('app/Http/Requests/Panel/'),
            __DIR__ . '/commands' => base_path('app/Console/Commands/'),
            __DIR__ . '/database/migrations' => base_path('database/migrations'),
            __DIR__ . '/resources/views' => base_path('resources/views/'),
            __DIR__ . '/seeders' => base_path('database/seeders'),
            __DIR__ . '/theme' => base_path('app/Classes/Theme'),
            __DIR__ . '/lang' => base_path('lang/fa'),
            __DIR__ . '/models' => base_path('app/Models/'),
            __DIR__ . '/providers' => base_path('app/Providers/'),
            __DIR__ . '/tools' => base_path('app/Tools'),
            __DIR__ . '/resources/assets' => base_path('public/panel/'),
            __DIR__ . '/config' => base_path('config'),
            __DIR__ . '/classes' => base_path('app/Repositories/'),
            __DIR__ . '/administrator_with_virtual_host.php' => base_path('routes/admin.php'),
        ], 'supernova-config');

        $this->publishes([
            __DIR__ . '/administrator_without_virtual_host.php' => base_path('routes/admin.php'),
        ], 'basic-routes');

        $this->publishes([
            __DIR__ . '/administrator_with_virtual_host.php' => base_path('routes/admin.php'),
        ], 'virtual-host-routes');
    }
}