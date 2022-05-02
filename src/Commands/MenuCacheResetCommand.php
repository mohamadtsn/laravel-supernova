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
        if (app(MenuManagerService::class)->forgetCachedMenus()) {
            $this->info('Menu cache flushed.');
        } else {
            $this->error('Unable to flush cache.');
        }
    }
}
