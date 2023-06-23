<?php

namespace Mohamadtsn\Supernova\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    protected $signature = 'supernova:publish {tags?*} {--F|force : rewriting all files }';

    protected $description = 'publish resources package';

    public function handle(): void
    {
        $tags = $this->argument('tags');
        $message = 'Declared sections published!';
        if (empty($tags)) {
            $tags = [
                'supernova-resources',
                'supernova-base-resources',
                'supernova-config',
                'supernova-migrations',
                'supernova-virtual-host-routes',
            ];
            $message = 'Default sections published!';
        }

        if (!$this->validateTags($tags)) {
            return;
        }

        $this->call('vendor:publish', [
            '--force' => $this->option('force'),
            '--tag' => $tags,
        ]);
        $this->info($message);
    }

    public function validateTags(array $tags): bool
    {
        $allowedTags = [
            'supernova-resources',
            'supernova-base-resources',
            'supernova-config',
            'supernova-migrations',
            'supernova-virtual-host-routes',
            'supernova-recaptcha-config',
            'supernova-basic-routes',
        ];
        foreach ($tags as $tag) {
            if (!in_array($tag, $allowedTags, true)) {
                $this->error("Invalid tag \{$tag\}");
                return false;
            }
        }
        return true;
    }
}
