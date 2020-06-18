<?php

namespace app\models;

use app\behaviors\MetaBehavior;
use app\queries\ProductQuery;
use DomainException;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;


use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $created_at
 * @property string $code
 * @property string $art
 * @property string $name
 * @property string $description
 * @property integer $category_id
 * @property integer $brand_id
 * @property float $price_old
 * @property float $price_new
 * @property string $photo_id
 * @property integer $status
 * @property integer $weight
 * @property integer $quantity
 * @property bool $is_sale
 * @property bool $is_new
 *
 * @property Meta $meta
 * @property Brand $brand
 * @property Category $category
 * @property CategoryAssignment[] $categoryAssignments
 * @property Category[] $categories
 * @property TagAssignment[] $tagAssignments
 * @property Tag[] $tags
 * @property RelatedAssignment[] $relatedAssignments
 * @property Value[] $values
 * @property Characteristic[] $characteristics
 * @property Photo $photo
 */
class Product extends ActiveRecord
{
    use EventTrait;

    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public $meta;

    public static function tableName(): string
    {
        return '{{%shop_products}}';
    }

    public static function create($brandId, $categoryId, $art, $code, $name, $description, $is_new, $is_sale, Meta $meta): self
    {
        $product = new static();
        $product->brand_id = $brandId;
        $product->category_id = $categoryId;
        $product->art = $art;
        $product->code = $code;
        $product->name = $name;
        $product->description = $description;
        $product->is_new = $is_new;
        $product->is_sale = $is_sale;
        $product->meta = $meta;
        $product->status = self::STATUS_DRAFT;
        $product->created_at = time();
        return $product;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'code' => 'Код товара',
            'art' => 'Артикул',
            'brand_id' => 'Производитель',
            'category_id' => 'Категория',
            'status' => 'Статус',
            'price_new' => 'Цена',
            'price_old' => 'Старая цена',
            'is_new' => 'Новый',
            'is_sale' => 'Акция',
        ];
    }

    public function setPrice($new, $old): void
    {
        $this->price_new = $new;
        $this->price_old = $old;
    }


    public function edit($brandId, $code, $name, $description, $is_new, $is_sale, Meta $meta): void
    {
        $this->brand_id = $brandId;
        $this->code = $code;
        $this->name = $name;
        $this->description = $description;
        $this->is_new = $is_new;
        $this->is_sale = $is_sale;
        $this->meta = $meta;
    }

    public function changeCategory($categoryId): void
    {
        if ($this->category_id != $categoryId) {
            $this->category_id = $categoryId;
        }
        $this->category_id = $categoryId;
    }

    public function activate(): void
    {
        if ($this->isActive()) {
            throw new DomainException('Товар уже активный.');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function draft(): void
    {
        if ($this->isDraft()) {
            throw new DomainException('Товар уже в черновиках.');
        }
        $this->status = self::STATUS_DRAFT;
    }

    public function isActive(): bool
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function isNew(): bool
    {
        return $this->is_new;
    }
    public function isSale(): bool
    {
        return $this->is_sale;
    }

    public function isDraft(): bool
    {
        return $this->status == self::STATUS_DRAFT;
    }

    public function checkout($modificationId, $quantity): void
    {
        if ($modificationId) {
            $modifications = $this->modifications;
            foreach ($modifications as $i => $modification) {
                if ($modification->isIdEqualTo($modificationId)) {
                    $modification->checkout($quantity);
                    $this->updateModifications($modifications);
                    return;
                }
            }
        }
        if ($quantity > $this->quantity) {
            throw new DomainException('Only ' . $this->quantity . ' items are available.');
        }
        $this->setQuantity($this->quantity - $quantity);
    }


    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->name;
    }

    public function setValue($characteristicId, $value): void
    {

        $val = Value::findOne(['characteristic_id' => $characteristicId, 'product_id' => $this->id]);
        if (!$val) {
            $val = Value::create($this->id, $characteristicId, $value);
            $val->save();
        } else {
            $val->change($value);
        }
    }

    public function getValue($id): Value
    {
        $values = $this->values;
        foreach ($values as $val) {
            if ($val->isForCharacteristic($id)) {
                return $val;
            }
        }
        return Value::blank($id);
    }

    public function assignCategory($id): void
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForCategory($id)) {
                return;
            }
        }
        $assignments[] = CategoryAssignment::create($id);
        $this->categoryAssignments = $assignments;
    }

    public function revokeCategory($id): void
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForCategory($id)) {
                unset($assignments[$i]);
                $this->categoryAssignments = $assignments;
                return;
            }
        }
        throw new DomainException('Assignment is not found.');
    }

    public function revokeCategories(): void
    {
        $this->categoryAssignments = [];
    }

    public function assignTag($id): void
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForTag($id)) {
                return;
            }
        }
        $assignments[] = TagAssignment::create($id);
        $this->tagAssignments = $assignments;
    }

    public function revokeTag($id): void
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForTag($id)) {
                unset($assignments[$i]);
                $this->tagAssignments = $assignments;
                return;
            }
        }
        throw new DomainException('Assignment is not found.');
    }

    public function revokeTags(): void
    {
        $this->tagAssignments = [];
    }

    // Photos

    public function setPhoto($id): void
    {
        $this->photo_id = $id;
    }

    public function removePhoto($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                unset($photos[$i]);
                $this->updatePhotos($photos);
                return;
            }
        }
        throw new DomainException('Photo is not found.');
    }

    public function removePhotos(): void
    {
        $this->updatePhotos([]);
    }


    private function updatePhotos(array $photos): void
    {
        foreach ($photos as $i => $photo) {
            $photo->setSort($i);
        }
        $this->photos = $photos;
        $this->populateRelation('mainPhoto', reset($photos));
    }

    public function getBrand(): ActiveQuery
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }


    public function getCategories(): ActiveQuery
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->via('categoryAssignments');
    }

    public function getTagAssignments(): ActiveQuery
    {
        return $this->hasMany(TagAssignment::class, ['product_id' => 'id']);
    }

    public function getTags(): ActiveQuery
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->via('tagAssignments');
    }

    public function getValues(): ActiveQuery
    {
        return $this->hasMany(Value::class, ['product_id' => 'id']);
    }

    public function getPhoto(): ActiveQuery
    {
        return $this->hasOne(Photo::class, ['id' => 'photo_id']);
    }


    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['categoryAssignments', 'tagAssignments', 'relatedAssignments', 'modifications', 'values', 'photos', 'reviews'],
            ],
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function beforeDelete(): bool
    {
        if (parent::beforeDelete()) {
            $photo = $this->photo;
            if ($photo)
                $photo->delete();
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes): void
    {
        $related = $this->getRelatedRecords();
        parent::afterSave($insert, $changedAttributes);
        if (array_key_exists('mainPhoto', $related)) {
            $this->updateAttributes(['main_photo_id' => $related['mainPhoto'] ? $related['mainPhoto']->id : null]);
        }
    }

    public static function find(): ProductQuery
    {
        return new ProductQuery(static::class);
    }

    public function getCharacteristics(): ActiveQuery
    {
        return $this->hasMany(Characteristic::class, ['id' => 'characteristic_id'])
            ->viaTable('shop_values', ['product_id' => 'id'])
            ->orderBy('sort');
    }

    public function makeNew()
    {
        $this->is_new = !$this->is_new;
    }
    public function makeSale()
    {
        $this->is_sale = !$this->is_sale;
    }


}