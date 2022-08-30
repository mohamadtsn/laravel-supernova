<?php

namespace Mohamadtsn\Supernova\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    protected $signature = 'supernova:publish {--F|force : rewriting all files }';

    protected $description = 'publish resources package';

    public function handle(): void
    {
        $this->call('vendor:publish', [
            '--force' => $this->option('force'),
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
