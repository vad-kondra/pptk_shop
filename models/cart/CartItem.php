<?php


namespace app\models\cart;


use app\models\Product;

class CartItem
{
    private $product;
    private $quantity;

    public function __construct(Product $product, $quantity)
    {
//				if (!$product->canBeCheckout($quantity)) {
//						throw new \DomainException('Слишком большое количество.');
//				}
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getId(): string
    {
        return md5(serialize($this->product->id));
    }

    public function getProductId(): int
    {
        return $this->product->id;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }


    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): int
    {
        return $this->product->price_new;
    }

    public function getWeight(): int
    {
        return $this->product->weight * $this->quantity;
    }

    public function getCost(): int
    {
        return $this->getPrice() * $this->quantity;
    }

    public function plus($quantity)
    {
        return new static($this->product, $this->quantity + $quantity);
    }

    public function changeQuantity($quantity)
    {
        return new static($this->product, $quantity);
    }
}