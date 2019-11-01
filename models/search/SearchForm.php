<?php


namespace app\models\search;


use app\models\Brand;
use app\models\Category;
use app\models\Characteristic;
use app\models\CompositeForm;

use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;


/**
 * @property ValueForm[] $values
 */

class SearchForm extends CompositeForm
{
    public $text;
    public $category;
    public $brand;

    public function __construct(array $config = [])
    {
        $this->values = array_map(function (Characteristic $characteristic) {
            return new ValueForm($characteristic);
        }, Characteristic::find()->orderBy('sort')->all());
        parent::__construct($config);
    }


    public function rules()
    {
        return [
            [['text'], 'string'],
            [['category', 'brand'], 'integer'],
        ];
    }

    public function categoriesListForSearchForm(): array
    {
        return ArrayHelper::map(Category::find()->andWhere(['>', 'depth', 0])->andWhere(['<', 'depth', 4])->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }
    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }

    public function brandsList(): array
    {
        return ArrayHelper::map(Brand::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    public function formName(): string
    {
        return '';
    }

    public function initChars($params = null)
    {
        $query = Characteristic::find()->orderBy('sort');
        //print ('<pre>');print_r($this->category);die();
        if ($this->category) {
            $category = Category::findOne($this->category);
            $ids = ArrayHelper::merge([$category->id], $category->getDescendants()->select('id')->column());

            $query
                ->leftJoin('shop_characteristics_to_category', 'shop_characteristics.id = shop_characteristics_to_category.characteristic_id')
                ->where(['or', ['shop_characteristics_to_category.category_id' => $ids]]);
        }

        $this->values = array_map(function (Characteristic $characteristic) {
            return new ValueForm($characteristic);
        }, $query->all());
        $this->load($params);
    }

    protected function internalForms(): array
    {
        return ['values'];
    }

    public function attributeLabels()
    {
        return [
            'text' => 'Текст',
            'category' => 'Категория',
            'brand' => 'Производитель'
        ];
    }


}