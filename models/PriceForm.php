<?php


namespace app\models;


use yii\base\Model;

/**
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property TagsForm $tags
 * @property ValueForm[] $values
 */
class PriceForm extends Model
{
    public $old;
    public $new;

    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->new = $product->price_new;
            $this->old = $product->price_old;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['new'], 'required'],
            [['old', 'new'], 'number', 'min' => 0, 'max' => 100000],
        ];
    }

		public function attributeLabels()
		{
				return [
					'new' => 'Цена',
					'old' => 'Старая цена',
				];
		}
}