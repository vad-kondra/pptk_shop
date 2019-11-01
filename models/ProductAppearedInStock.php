<?php


namespace app\models;


class ProductAppearedInStock
{
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}