<?php


namespace app\repositories;


use app\models\Category;

class CategoryRepository
{

    public function getByName($name): ?Category
    {
        if (!$category = Category::findOne(['name' => $name])) {
            return null;
        }
        return $category;
    }


    public function get($id): Category
    {
        if (!$category = Category::findOne($id)) {
            throw new NotFoundException('Категория не найдена.');
        }
        return $category;
    }

    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new \RuntimeException('Ошибка сохранения.');
        }

    }

    public function remove(Category $category): void
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Ошибка удаления.');
        }

    }
}