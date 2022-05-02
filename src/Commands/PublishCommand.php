<?php

namespace Mohamadtsn\Supernova\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    protected $signature = 'supernova:publish';

    protected $description = 'publish resources package';

    public function handle(): void
    {
        $this->call('vendor:publish', [
            '--tag' => [
                'supernova-resources',
                'supernova-base-resources',
                'supernova-migrations',
                'supernova-virtual-host-routes',
            ],
            '--force' => ''
        ]);
    }
}
