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
            '--force' => true,
            '--tag' => [
                'supernova-resources',
                'supernova-base-resources',
                'supernova-config',
                'supernova-migrations',
                'supernova-virtual-host-routes',
            ]
        ]);
    }
}
