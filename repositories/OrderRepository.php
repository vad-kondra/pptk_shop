<?php


namespace app\repositories;


use app\models\order\Order;

class OrderRepository
{
		public function get($id): Order
{
		if (!$order = Order::findOne($id)) {
				throw new NotFoundException('Order is not found.');
		}
		return $order;
}

		public function save(Order $order): void
		{
				//print ('<pre>');print_r($order);die();
				if (!$order->save()) {
						throw new \RuntimeException('Saving error.');
				}
		}

		public function remove(Order $order): void
		{
				if (!$order->delete()) {
						throw new \RuntimeException('Removing error.');
				}
		}

		public function getAllOrdersByUserId(int $userId): array
		{
				return Order::find()->where(['user_id' => $userId])->all();
		}
}