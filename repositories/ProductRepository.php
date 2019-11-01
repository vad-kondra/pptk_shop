<?php

namespace app\repositories;

use app\models\Product;
use RuntimeException;

class ProductRepository
{
    public function get($id): Product
    {
        if (!$product = Product::findOne($id)) {
            throw new NotFoundException('Product is not found.');
        }
        return $product;
    }
    public function existsByBrand($id): bool
    {
        return Product::find()->andWhere(['brand_id' => $id])->exists();
    }
    public function existsByMainCategory($id): bool
    {
        return Product::find()->andWhere(['category_id' => $id])->exists();
    }
    public function save(Product $product): void
    {
        if (!$product->save(false)) {
            throw new RuntimeException('Ошибка сохранения.');
        }
    }
    public function remove(Product $product): void
    {
        if (!$product->delete()) {
            throw new RuntimeException('Ошибка удаления.');
        }
    }
}