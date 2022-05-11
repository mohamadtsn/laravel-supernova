<?php
if (!function_exists('makePersianNumber')) {
    /**
     * @param $string
     * @return array|string
     */
    function makePersianNumber($string): array|string
    {
        return str_replace([0, 1, 2, 3, 4, 5, 6, 7, 8, 9], ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'], $string);
    }
}

if (!function_exists('makeEnglishNumber')) {
    /**
     * @param $string
     * @return array|string
     */
    function makeEnglishNumber($string): array|string
    {
        return str_replace(['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'], [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], $string);
    }
}