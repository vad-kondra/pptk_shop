<?php


namespace app\services;




use app\models\cart\Cart;
use app\models\cart\CartItem;
use app\repositories\ProductRepository;

class CartService
{
    private $cart;
    private $productRepository;

    public function __construct(Cart $cart, ProductRepository $products)
    {
        $this->cart = $cart;
        $this->productRepository = $products;
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }

    public function add(int $productId,  int $quantity): Cart
    {
        $product = $this->productRepository->get($productId);

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