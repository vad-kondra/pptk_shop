<?php


namespace app\models;


use yii\helpers\ArrayHelper;

/**
 * @property PriceForm $price
 * @property MetaForm $meta
 * @property PhotoForm $photo
 * @property CategoriesForm $categories
 * @property TagsForm $tags
 */
class ProductCreateForm extends CompositeForm
{
    public $brandId;
    public $code;
    public $art;
    public $name;
    public $description;
    public $is_new;
    public $is_sale;


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'art' => 'Артикул',
            'brandId' => 'Производитель',
            'code' => 'Код',
            'description' => 'Описание',
            'is_new' => 'Новинка',
            'is_sale' => 'Акция'
        ];
    }

    public function __construct($config = [])
    {
        $this->price = new PriceForm();
        $this->meta = new MetaForm();
        $this->categories = new CategoriesForm();
        $this->photo = new PhotoForm();
        $this->tags = new TagsForm();
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['brandId', 'code', 'name','art'], 'required'],
            [['code', 'name', 'art',], 'string', 'max' => 255],
            [['code', 'name', 'art',], 'trim'],
            [['brandId'], 'integer'],
            [['is_new', 'is_sale'], 'boolean'],
            ['description', 'string'],
        ];
    }

    public function brandsList(): array
    {
        return ArrayHelper::map(Brand::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    protected function internalForms(): array
    {
        return ['price', 'meta', 'photo', 'categories', 'tags',];
    }
}