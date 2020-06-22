<?php

namespace app\services;

use app\models\cart\Cart;
use app\models\cart\CartItem;
use app\models\order\CustomerData;
use app\models\order\Order;
use app\models\order\OrderItem;
use app\models\OrderForm;
use app\repositories\OrderRepository;
use app\repositories\productRepository\IProductRepository;
use app\repositories\userRepository\UserRepository;

class OrderService
{
    private $cart;
    private $_orderRepository;
    private $_productRepository;
    private $_userRepository;

    public function __construct(
        Cart $cart,
        OrderRepository $orderRepository,
        IProductRepository $productRepository,
        UserRepository $userRepository)
    {
        $this->cart = $cart;
        $this->_orderRepository = $orderRepository;
        $this->_productRepository = $productRepository;
        $this->_userRepository = $userRepository;
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


        $this->_orderRepository->save($order);
        foreach ($products as $product) {
            $this->_productRepository->save($product);
        }
        $this->cart->clear();

        return $order;
    }
}