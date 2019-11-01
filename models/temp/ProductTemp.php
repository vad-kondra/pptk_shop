<?php


namespace app\models\temp;


use yii\db\ActiveRecord;

class ProductTemp extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%temp_product}}';
    }
}