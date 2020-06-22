<?php

namespace app\repositories\productRepository;

use app\models\Product;

interface IProductRepository
{
    public function get($id): Product;

    public function existsByBrand($id): bool;

    public function existsByMainCategory($id): bool;

    public function save(Product $product): void;

    public function remove(Product $product): void;

}