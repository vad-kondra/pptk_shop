<?php


namespace app\models;

use yii\helpers\ArrayHelper;

/**
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property TagsForm $tags
 */
class ProductEditForm extends CompositeForm
{
    public $name;
    public $art;
    public $code;
    public $brandId;
    public $description;
    public $is_new;
    public $is_sale;

    private $_product;

    public function __construct(Product $product, $config = [])
    {
        $this->brandId = $product->brand_id;
        $this->code = $product->code;
        $this->art = $product->art;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->is_new = $product->is_new;
        $this->is_sale = $product->is_sale;
        $this->meta = new MetaForm($product->meta);
        $this->categories = new CategoriesForm($product);
        $this->tags = new TagsForm($product);
        $this->_product = $product;
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
            [['code'], 'unique', 'targetClass' => Product::class, 'filter' => $this->_product ? ['<>', 'id', $this->_product->id] : null],
            ['description', 'string'],
        ];
    }

    public function brandsList(): array
    {
        return ArrayHelper::map(Brand::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    protected function internalForms(): array
    {
        return ['meta', 'categories', 'tags'];
    }


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
}