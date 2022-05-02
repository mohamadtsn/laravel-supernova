<?php

namespace Mohamadtsn\Supernova\Classes;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Arr;

class MenuManagerService
{
    /** @var Repository */
    protected Repository $cache;

    /** @var CacheManager */
    protected CacheManager $cacheManager;

    /** @var array */
    protected array $menuItems;

    /** @var int|\DateInterval|Carbon */
    public static Carbon|int|\DateInterval $cacheExpirationTime;

    /** @var bool */
    public static bool $cacheStatus;

    /** @var string */
    public static string $cacheKey;

    public function __construct(CacheManager $cacheManager)
    {
        $this->cacheManager = $cacheManager;
        $this->menuItems = config('supernova.menu_aside.items');

        $this->initializeCache();
    }

    public function initializeCache(): void
    {
        $this->initializeCacheAttrs();

        $this->cache = $this->getCacheStoreFromConfig();
    }

    private function initializeCacheAttrs(): void
    {
        $vertical_menu = config('supernova.cache', []);

        self::$cacheExpirationTime = Arr::get($vertical_menu, 'expiration_time', now()->addMonth());
        self::$cacheKey = Arr::get($vertical_menu, 'key', 'supernova.menu');
        self::$cacheStatus = ($enable = Arr::get($vertical_menu, 'enable')) === 'automatic' ? app()->environment('production') : (bool)$enable;
    }

    private function adminId(): int|string|null
    {
        return auth('admin')->id();
    }

    protected function getCacheStoreFromConfig(): Repository
    {
        // the 'default' fallback here is from the 'supernova.php' config file,
        // where 'default' means to use config(cache.default)
        $cacheDriver = config('supernova.vertical_menu.cache.store', 'default');

        // when 'default' is specified, no action is required since we already have the default instance
        if ($cacheDriver === 'default') {
            return $this->cacheManager->store();
        }

        // if an undefined cache store is specified, fallback to 'array' which is Laravel closest equiv to 'none'
        if (!\array_key_exists($cacheDriver, config('cache.stores'))) {
            $cacheDriver = 'array';
        }

        return $this->cacheManager->store($cacheDriver);
    }

    public function getVerticalMenu()
    {
        if (self::$cacheStatus) {
            return $this->loadVerticalMenuFromCache();
        }
        return $this->generateVerticalMenu();
    }

    public function loadVerticalMenuFromCache()
    {
        return $this->getCacheRepository()->remember($this->getCacheKey(), self::$cacheExpirationTime, function () {
            return $this->generateVerticalMenu();
        });
    }

    public function generateVerticalMenu(): string
    {
        ob_start();
        Menu::renderVerMenu($this->menuItems);
        $menu = ob_get_clean();
        if (!$menu) {
            throw new \RuntimeException('Unavailable buffer.');
        }
        return $menu;
    }

    public function forgetCachedMenus(): bool
    {
        return $this->getCacheRepository()->forget($this->getCacheKey());
    }

    public function forgetCachedMenusForUsers(User $user): bool
    {
        return $this->getCacheRepository()->forget($this->getCacheKey($user->getKey()));
    }

    public function getCacheRepository(): Repository
    {
        return $this->cache;
    }

    public function getCacheStore(): Store
    {
        return $this->getCacheRepository()->getStore();
    }

    private function getCacheKey($id = null): string
    {
        return self::$cacheKey . '_#_' . ($id ?? $this->adminId());
    }
}
