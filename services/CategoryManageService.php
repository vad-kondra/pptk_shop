<?php

namespace app\services;

use app\models\Category;
use app\models\CategoryForm;
use app\models\Characteristic;
use app\models\CharacteristicsToCategory;
use app\models\CharToCatForm;
use app\models\Meta;
use app\models\temp\CategoryTemp;
use app\repositories\CategoryRepository;
use app\repositories\CharacteristicRepository;
use app\repositories\ProductRepository;
use yii\base\BaseObject;
use yii\db\StaleObjectException;

class CategoryManageService extends BaseObject
{
    private $categories;
    private $products;
    private $characteristics;

    public function __construct(CategoryRepository $categories, CharacteristicRepository $characteristics, ProductRepository $products, $config = [])
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

//TODO     temp DELETE THIS
    public function createFromTemp(CategoryTemp $temp): Category
    {
        $tempParent = CategoryTemp::findOne($temp->parent_id);

        $parent = $this->categories->getByName($tempParent->name);

        $category = Category::create(
            $temp->name,
            $temp->name,
            null,
            new Meta(
                $temp->name,
                null,
                null
            )
        );
        $category->slug = transliterate($temp->name);


        if (!$this->categories->getByName($category->name)) {
            $category->appendTo($parent);
            $this->categories->save($category);
        }

        return $category;
    }
//TODO     temp DELETE THIS
}