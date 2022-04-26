<?php

function makePersianNumber($string)
{
    return str_replace([0, 1, 2, 3, 4, 5, 6, 7, 8, 9], ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"], $string);
}

/**
 * @param $string
 * @return array|string|string[]
 */
function makeEnglishNumber($string)
{
    return str_replace(["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"], [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], $string);
}
