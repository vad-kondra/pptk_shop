<?php


namespace app\models\cart\storage;


use app\models\cart\CartItem;
use app\models\Product;
use yii\db\Connection;
use yii\db\Exception;
use yii\db\Query;

class DbStorage implements StorageInterface
{
    private $userId;
    private $db;

    public function __construct($userId, Connection $db)
    {
        $this->userId = $userId;
        $this->db = $db;
    }

    public function load(): array
    {
        $rows = (new Query())
            ->select('*')
            ->from('{{%shop_cart_items}}')
            ->where(['user_id' => $this->userId])
            ->orderBy(['product_id' => SORT_ASC])
            ->all($this->db);

        return array_map(function (array $row) {
            /** @var Product $product */
            if ($product = Product::find()->active()->with('photo')->andWhere(['id' => $row['product_id']])->one()) {
                return new CartItem($product, $row['quantity']);
            }
            return false;
        }, $rows);
    }

    public function save(array $items): void
    {
        try {
            $this->db->createCommand()
                ->delete('{{%shop_cart_items}}', [
                'user_id' => $this->userId,
                ])->execute();

            $this->db->createCommand()
                ->batchInsert('{{%shop_cart_items}}',
                [
                    'user_id',
                    'product_id',
                    'quantity'
                ],
                array_map(function (CartItem $item) {
                    return [
                        'user_id' => $this->userId,
                        'product_id' => $item->getProductId(),
                        'quantity' => $item->getQuantity(),
                    ];
                }, $items)
            )->execute();
        } catch (Exception $e) {
        }
    }
}