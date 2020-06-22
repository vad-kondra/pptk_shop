<?php

namespace app\services\cartService;


use app\models\cart\Cart;
use app\models\cart\CartItem;
use app\repositories\productRepository\ProductRepository;

class CartService
{
    private $_productRepository;
    private $cart;

    public function __construct(
        ProductRepository $productRepository,
        Cart $cart)
    {
        $this->_productRepository = $productRepository;
        $this->cart = $cart;
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }

    public function add(int $productId,  int $quantity): Cart
    {
        $product = $this->_productRepository->get($productId);
        $this->cart->add(new CartItem($product, $quantity));

        return $this->cart;
    }

    public function set($id, $quantity): void
    {
        $this->cart->set($id, $quantity);
    }

    public function remove($id): void
    {
        $this->cart->remove($id);
    }

    public function clear(): void
    {
        $this->cart->clear();
    }
}