<?php


namespace app\models;


use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $required
 * @property string $default
 * @property array $variants
 * @property integer $sort
 * @property integer $category_id
 * @property Category $category
 */
class Characteristic extends ActiveRecord
{
    const TYPE_STRING = 'string';
    const TYPE_INTEGER = 'integer';
    const TYPE_FLOAT = 'float';

    public $variants;

    public static function create($name, $type, $required, $default, array $variants, $sort): self
    {
        $object = new static();
        $object->name = $name;
        $object->type = $type;
        $object->required = $required;
        $object->default = $default;
        $object->variants = $variants;
        $object->sort = $sort;
        return $object;
    }

    public function edit($name, $type, $required, $default, array $variants, $sort): void
    {
        $this->name = $name;
        $this->type = $type;
        $this->required = $required;
        $this->default = $default;
        $this->variants = $variants;
        $this->sort = $sort;
    }

    public function isString(): bool
    {
        return $this->type === self::TYPE_STRING;
    }

    public function isInteger(): bool
    {
        return $this->type === self::TYPE_INTEGER;
    }

    public function isFloat(): bool
    {
        return $this->type === self::TYPE_FLOAT;
    }

    public function isSelect(): bool
    {
        return count($this->variants) > 0;
    }

    public static function tableName(): string
    {
        return '{{%shop_characteristics}}';
    }

    public function afterFind(): void
    {
        $variants = Json::decode($this->getAttribute('variants_json'));
        if (is_array($variants)) {
            $this->variants = array_filter($variants);
        } else {
            $this->variants = [];
        }
        parent::afterFind();
    }

    public function beforeSave($insert): bool
    {
        $this->setAttribute('variants_json', Json::encode(array_filter($this->variants)));
        return parent::beforeSave($insert);
    }

    public function getCategories(): ActiveQuery {

        return $this->hasMany(Category::class, ['id' => 'characteristic_id'])
            ->viaTable('shop_characteristics_to_category', ['category_id' => 'id']);
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'type' => 'Тип',
            'required' => 'Обязательный',
        ];
    }
}
