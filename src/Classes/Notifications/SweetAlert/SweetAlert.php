<?php

namespace Mohamadtsn\Supernova\Classes\Notifications\SweetAlert;

class SweetAlert
{
    public static function hasSweetAlert()
    {
        return \Session::has('alert.config');
    }

    public function renderRaw(): string
    {
        $object_name = config('sweetalert.render.global_object', 'sweetAlertData');
        return "window.$object_name = " . $this->getAlertConfiguration() .';';
    }

    public function render(): string
    {
        return "<script> " . $this->renderRaw() . " </script>";
    }

    public function getAlertConfiguration()
    {
        return \Session::pull('alert.config');
    }
}