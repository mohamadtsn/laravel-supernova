<?php

namespace Mohamadtsn\Supernova\Classes\Traits;

use Mohamadtsn\Supernova\Classes\MenuManagerService;

trait MenuGenerator
{
    public static function loadVerticalMenu(): mixed
    {
        return app(MenuManagerService::class)->getVerticalMenu();
    }

    private static function checkStatusItemsAfterSection(int $key_item): bool
    {
        $config = config('supernova.menu_aside.items');
        $other_items = array_slice($config, ($key_item + 1));
        $middle_item = [];
        foreach ($other_items as $value) {
            if (!isset($value['section'])) {
                if (isset($value['title']) && self::hasPermission($value)) {
                    $middle_item[] = $value;
                }
                continue;
            }
            break;
        }
        return count($middle_item) > 0;
    }

    private static function hasPermission($item): bool
    {
        $user = auth('admin')->user();
        if (isset($item['page'])) {
            if (is_array($item['page'])) {
                foreach ($item['page'] as $single_page) {
                    if ($user && ($user->level === 0 || $user->checkPermissionTo('GET-/' . ltrim($single_page, '/')))) {
                        return true;
                    }
                }
                return false;
            }
            if ($user && ($item['page'] === '/' || $user->level === 0 || $user->checkPermissionTo('GET-/' . ltrim($item['page'], '/')))) {
                return true;
            }
            return false;
        }
        return true;
    }
}
