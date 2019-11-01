<?php


namespace app\helpers;


use app\models\Characteristic;
use yii\helpers\ArrayHelper;


class CharacteristicHelper
{
    public static function typeList(): array
    {
        return [
            Characteristic::TYPE_STRING => 'Текстовый',
            Characteristic::TYPE_INTEGER => 'Числовой',
            Characteristic::TYPE_FLOAT => 'С плавающей запятой',
        ];
    }

    public static function typeName($type): string
    {
        return ArrayHelper::getValue(self::typeList(), $type);
    }
}