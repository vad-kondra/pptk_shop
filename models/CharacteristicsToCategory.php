<?php


namespace app\models;


use yii\db\ActiveRecord;

/**
 * @property integer $category_id;
 * @property integer $characteristic_id;
 */

class CharacteristicsToCategory extends ActiveRecord
{
    public static function create($charId): self
    {
        $charToCat = new static();
        $charToCat->characteristic_id = $charId;
        return $charToCat;
    }


    public static function tableName(): string
    {
        return '{{%shop_characteristics_to_category}}';
    }

    public function isForChar($id)
    {
        return $this->characteristic_id == $id;
    }
}