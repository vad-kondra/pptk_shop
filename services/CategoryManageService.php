<?php

namespace app\services;

use app\models\Category;
use app\models\CategoryForm;
use app\models\Meta;
use app\repositories\CategoryRepository;
use app\repositories\CharacteristicRepository;
use app\repositories\productRepository\ProductRepository;
use yii\base\BaseObject;

class CategoryManageService extends BaseObject
{
    private $categories;
    private $products;
    private $characteristics;

    public function __construct(
        CategoryRepository $categories,
        CharacteristicRepository $characteristics,
        ProductRepository $products,
        $config = [])
    {
        parent::__construct($config);
        $this->categories = $categories;
        $this->products = $products;
        $this->characteristics = $characteristics;
    }

    public function create(CategoryForm $form): Category
    {
        $parent = $this->categories->get($form->parentId);
        $category = Category::create(
            $form->name,
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $category->slug = transliterate($category->name);
        $category->appendTo($parent);
        $this->categories->save($category);
        return $category;
    }

    public function edit($id, CategoryForm $form): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        $category->edit(
            $form->name,
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $category->slug = transliterate($category->name);
        if ($form->parentId !== $category->parent->id) {
            $parent = $this->categories->get($form->parentId);
            $category->appendTo($parent);
        }
        $this->categories->save($category);
    }

    public function moveUp($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($prev = $category->prev) {
            $category->insertBefore($prev);
        }
        $this->categories->save($category);
    }

    public function moveDown($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($next = $category->next) {
            $category->insertAfter($next);
        }
        $this->categories->save($category);
    }

    public function remove($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($this->products->existsByMainCategory($category->id)) {
            throw new \DomainException('Невозможно удалить категорию, содержащую товары.');
        }
        $this->categories->remove($category);
    }

    private function assertIsNotRoot(Category $category): void
    {
        if ($category->isRoot()) {
            throw new \DomainException('Невозможно управлять корневой категорией.');
        }
    }

}