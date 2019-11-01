<?php


namespace app\helpers;


class PriceHelper
{

    public static function format($price): string
    {
        return number_format($price, 2, '.', ' ').'&nbsp;руб.';
    }
}