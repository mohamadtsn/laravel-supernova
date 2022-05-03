<?php

namespace Mohamadtsn\Supernova\Commands;

use Illuminate\Console\Command;
use Mohamadtsn\Supernova\Classes\MenuManagerService;

class MenuCacheResetCommand extends Command
{
    protected $signature = 'supernova:menu-clear';

    protected $description = 'Clear menu cache.';

    public function handle(): void
    {
        if (app(MenuManagerService::class)->forgetCachedMenusForUsers($this->laravel['auth']->guard('admin')->user())) {
            $this->info('Menu cache flushed.');
        } else {
            $this->error('Unable to flush cache.');
        }
    }
}
