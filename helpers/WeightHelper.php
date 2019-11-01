<?php


namespace app\helpers;


class WeightHelper
{
    public static function format($weight): string
    {
        return $weight / 1000 . ' kg';
    }
}