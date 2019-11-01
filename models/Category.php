<?php


namespace app\models;


use app\behaviors\MetaBehavior;
use app\queries\CategoryQuery;
use paulzi\nestedsets\NestedSetsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property Meta $meta
 * @property Characteristic[] $characteristics
 *
 * @property Category $parent
 * @property Category[] $parents
 * @property Category[] $children
 * @property CharacteristicsToCategory[] $characteristicsToCategory
 * @property Category $prev
 * @property Category $next
 * @mixin NestedSetsBehavior
 */
class Category extends ActiveRecord
{
    public $meta;

    public static function create($name, $title, $description, Meta $meta): self
    {
        $category = new static();
        $category->name = $name;
        $category->title = $title;
        $category->description = $description;
        $category->meta = $meta;
        return $category;
    }

    public function edit($name, $title, $description, Meta $meta): void
    {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->meta = $meta;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->getHeadingTile();
    }

    public function getHeadingTile(): string
    {
        return $this->title ?: $this->name;
    }

    public static function tableName(): string
    {
        return '{{%shop_categories}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
            NestedSetsBehavior::class,
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find(): CategoryQuery
    {
        return new CategoryQuery(static::class);
    }



    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'title' => 'Заголовок',
        ];
    }


}