<?php


namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property integer $characteristic_id
 * @property integer $product_id
 * @property string $value
 * @property Characteristic $characteristic
 */
class Value extends ActiveRecord
{
    public static function create($productId, $characteristicId, $value = null): self
    {
        $object = new static();
        $object->characteristic_id = $characteristicId;
        $object->product_id = $productId;
        $object->value = $value;
        return $object;
    }

    public static function blank($characteristicId): self
    {
        $object = new static();
        $object->characteristic_id = $characteristicId;
        return $object;
    }

    public function change($value): void
    {
        $this->value = $value;
        $this->save();
    }

    public function isForCharacteristic($id): bool
    {
        return $this->characteristic_id == $id;
    }

    public function getCharacteristic(): ActiveQuery
    {
        return $this->hasOne(Characteristic::class, ['id' => 'characteristic_id']);
    }

    public static function tableName(): string
    {
        return '{{%shop_values}}';
    }


    public function attributeLabels()
    {
        return [
            'value' => 'Значение',
        ];
    }

    public function charList(): array
    {
        return ArrayHelper::map(Characteristic::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }


}
