<?php

namespace Mohamadtsn\Supernova\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;
use Mohamadtsn\Supernova\Models\Permission;

class PermissionSyncCommand extends Command
{
    protected $signature = 'supernova:permissions-sync';

    protected $description = 'sync permissions with routes list';

    public function handle(): void
    {
        foreach ($this->getRoutes() as $route) {
            $ignore = false;
            $array = explode('/', $route->url);
            if (empty($array[0])) {
                $displayName = $this->displayName('dashboard');
                $ignore = true;
            }

            if (count($array) === 1) {
                //set single word for {Create Requests}
                if ($route->method === 'POST') {
                    $displayName = $this->getMethodName($route->method);
                    $displayName .= $this->displayName($array[0], 'single');
                    $ignore = true;
                } //set {List} word for show a list of data
                else if ($route->method === 'GET') {
                    $displayName = $this->displayName('list');
                    $displayName .= $this->displayName($array[0]);
                    $ignore = true;
                }
            }

            if (!$ignore) {
                //get Method name translation
                $displayName = $this->getMethodName($route->method);
                $single_name = false;
                foreach (array_reverse($array) as $key => $word) {
                    //if exist clear_method in current word remove word method
                    if ($key === 0 && ($clear_method = $this->displayName($word, 'clear_method', true)) && is_array($clear_method) && in_array($route->method, $clear_method, true)) {
                        $displayName = '';
                    }
                    //if it was a block word continue
                    if ($this->checkBlockWords($word)) {
                        continue;
                    }

                    //if it was a special word then break the loop
                    if ($this->checkSpecialWords($word)) {
                        if ($route->method === 'GET' && $key === 0) {
                            $displayName = $this->displayName('view');
                        }
                        $displayName .= $this->displayName($this->convertToManyWord($this->cleanString($word)), 'single');
                        break;
                    }

                    //convert word to single
                    if ($single_name) {
                        $displayName .= $this->displayName($word, 'single');
                        continue;
                    }
                    if ($key === 0 && $word === 'create') {
                        $single_name = true;
                    }
                    $displayName .= $this->displayName($word);
                }
            }

            Permission::upsert([
                'name' => "$route->method-/$route->url",
                'guard_name' => 'web',
                'display_name' => $displayName ?? null,
            ], 'name');
        }

        Artisan::call('permission:cache-reset');
        $this->comment('All permissions are synced by routes');
    }

    /**
     * @param string $method
     * @return string
     */
    private function getMethodName(string $method): string
    {
        return (Lang::has("routes.methods.$method") ? Lang::get("routes.methods.$method") : '(-)') . ' ';
    }

    /**
     * @param string $word
     * @return bool
     */
    private function checkSpecialWords(string $word): bool
    {
        return $this->contains($word, Lang::get('routes.specials'));
    }

    /**
     * @param string $word
     * @return bool
     */
    private function checkBlockWords(string $word): bool
    {
        return in_array($word, Lang::get('routes.blocked'), true);
    }

    /**
     * @param string $word
     * @param null $type
     * @param bool $pure
     * @return array|false|mixed|string|null
     */
    private function displayName(string $word, $type = null, bool $pure = false)
    {
        $path_word = "routes.accepted.$word";
        $get_word = Lang::get($path_word);
        if ($get_word === $path_word) {
            return '(-)' . ' ';
        }
        if ($pure) {
            return (!$type) ? $get_word : $get_word[$type] ?? false;
        }
        if (!$type) {
            return ((is_array($get_word)) ? ($get_word['many'] ?? '(-)') : $get_word) . ' ';
        }
        return ($get_word[$type] ?? '(-)') . ' ';
    }

    /**
     * @return array
     */
    private function getRoutes(): array
    {
        $routes = [];
        foreach (Route::getRoutes() as $route) {
            if (isset($route->action['domain']) && $route->action['domain'] === config('supernova.management_url') && !(in_array($route->uri, Lang::get('routes.blocked'), true))) {
                $routes[] = (object)[
                    'method' => $route->methods[0] ?? null,
                    'url' => $route->uri ?? null,
                    'domain' => $route->action['domain'] ?? null,
                ];
            }
        }
        return $routes;
    }

    private function contains($str, array $arr): bool
    {
        foreach ($arr as $a) {
            if (stripos($str, $a) !== false) {
                return true;
            }
        }
        return false;
    }

    private function convertToManyWord($word): string
    {
        return Str::plural($word);
    }

    private function cleanString(string $word)
    {
        return preg_replace('/[^A-Za-z\d\-\_]/', '', $word);
    }
}
