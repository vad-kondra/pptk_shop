<?php


namespace app\services;


use app\models\cart\Cart;
use app\models\cart\CartItem;
use app\models\order\CustomerData;
use app\models\order\Order;
use app\models\order\OrderItem;
use app\models\OrderForm;
use app\repositories\OrderRepository;
use app\repositories\ProductRepository;
use app\repositories\UserRepository;

class OrderService
{
    private $cart;
    private $orders;
    private $products;
    private $users;

    public function __construct(Cart $cart, OrderRepository $orders, ProductRepository $products, UserRepository $users)
    {
        $this->cart = $cart;
        $this->orders = $orders;
        $this->products = $products;
        $this->users = $users;
    }

    public function checkout($userId, OrderForm $form): Order
    {
        $products = [];
        $items = array_map(function (CartItem $item) use (&$products) {
            $product = $item->getProduct();
            $products[] = $product;
            return OrderItem::create(
                $product,
                $item->getPrice(),
                $item->getQuantity()
            );
        }, $this->cart->getItems());

        $order = Order::create(
            $userId,
            new CustomerData(
                $form->customer->f_name,
                $form->customer->l_name,
                $form->customer->p_name,
                $form->customer->email,
                $form->customer->phone,
                $form->customer->city,
                $form->customer->post_index,
                $form->customer->address
            ),
            $items,
            $this->cart->getCost()->getTotal(),
            $form->comment
        );


        $this->orders->save($order);
        foreach ($products as $product) {
            $this->products->save($product);
        }
        $this->cart->clear();

        return $order;
    }
}