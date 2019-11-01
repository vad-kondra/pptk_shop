<?php

namespace app\models\order;


use app\models\Product;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product_to_order".
 *
 * @property int $product_id
 * @property int $order_id
 * @property int $quantity
 * @property double $price
 * @property double $sum
 * @property string $name
 *
 * @property Order $order
 * @property Product $product
 */
class ProductToOrder extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_to_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'order_id'], 'required'],
            [['product_id', 'order_id', 'quantity'], 'integer'],
						[['price', 'sum'], 'number'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
					'product_id' => 'Product ID',
					'order_id' => 'Order ID',
					'name' => 'Название товара',
					'quantity' => 'Количество в заказе',
					'price' => 'Цена в заказе',
					'sum' => 'Сумма данного товара в заказе',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
