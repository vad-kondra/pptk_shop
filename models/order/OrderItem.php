<?php


namespace app\models\order;

use app\models\Product;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $modification_id
 * @property string $product_name
 * @property string $product_code
 * @property string $modification_name
 * @property string $modification_code
 * @property float $price
 * @property int $quantity
 * @property Product $product
 *
 *
 */
class OrderItem extends ActiveRecord
{
		public static function create(Product $product, $price, $quantity)
		{
				$item = new static();
				$item->product_id = $product->id;
				$item->product_name = $product->name;
				$item->product_code = $product->code;
				$item->price = $price;
				$item->quantity = $quantity;
				return $item;
		}

		public function getCost(): float
		{
				return $this->price * $this->quantity;
		}

		public static function tableName(): string
		{
				return '{{%shop_order_items}}';
		}


		/**
		 * @return ActiveQuery
		 */
		public function getProduct():ActiveQuery
		{
				return $this->hasOne(Product::class, ['id' => 'product_id']);
		}
}