<?php

namespace Mohamadtsn\Supernova\Classes\Notifications\Toaster;

use Yoeunes\Toastr\Toastr;

class Toaster extends Toastr
{
    public static function __callStatic(string $name, array $arguments)
    {
        return (new static(app('session'), app('config')))->$name(...$arguments);
    }

    /**
     * @return bool
     */
    public function hasToaster()
    {
        return $this->session->has(self::TOASTR_NOTIFICATIONS);
    }

    /**
     * @return string
     */
    public function renderRaw()
    {
        $toasterData = [
            $this->config->get('supernova-toaster.js.options_object', 'options') => $this->getRawOptions(),
            $this->config->get('supernova-toaster.js.notifications_object', 'notifications') => $this->getRawNotifications(),
        ];

        $toasterObject = "window." . $this->config->get('supernova-toaster.js.global_object', 'toasterData') . " = " . json_encode($toasterData) . ';';

        $this->session->forget(self::TOASTR_NOTIFICATIONS);

        return $toasterObject;
    }

    /**
     * @param bool $json
     * @return array|false|string
     */
    public function getRawOptions(bool $json = false)
    {
        $options = $this->config->get('supernova-toaster.options', []);

        return $json ? json_encode($options) : $options;
    }

    /**
     * @param bool $json
     * @return false|string
     */
    public function getRawNotifications(bool $json = false)
    {
        $notifications = $this->session->get(static::TOASTR_NOTIFICATIONS, []);

        return $json ? json_encode($notifications) : $notifications;
    }
}
