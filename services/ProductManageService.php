<?php

namespace app\services;

use app\models\CharacteristicsForm;
use app\models\Meta;
use app\models\Photo;
use app\models\PhotoForm;
use app\models\PriceForm;
use app\models\Product;
use app\models\ProductCreateForm;
use app\models\ProductEditForm;
use app\models\Tag;
use app\repositories\BrandRepository;
use app\repositories\CategoryRepository;
use app\repositories\ProductRepository;
use app\repositories\TagRepository;

class ProductManageService
{
    private $products;
    private $brands;
    private $categories;
    private $tags;

    public function __construct(
        ProductRepository $products,
        BrandRepository $brands,
        CategoryRepository $categories,
        TagRepository $tags)
    {
        $this->products = $products;
        $this->brands = $brands;
        $this->categories = $categories;
        $this->tags = $tags;
    }

    public function create(ProductCreateForm $form): Product
    {
        $brand = $this->brands->get($form->brandId);
        $category = $this->categories->get($form->categories->main);
        $product = Product::create(
            $brand->id,
            $category->id,
            $form->art,
            $form->code,
            $form->name,
            $form->description,
            $form->is_new,
            $form->is_sale,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $product->setPrice($form->price->new, $form->price->old);
        $image = $form->photo->image;
        if ($image){
            $photo = Photo::create($image, $form->code);
            $photo->save();
            $product->setPhoto($photo->id);
        }
        foreach ($form->tags->existing as $tagId) {
            $tag = $this->tags->get($tagId);
            $product->assignTag($tag->id);
        }

        foreach ($form->tags->newNames as $tagName) {
            if (!$tag = $this->tags->findByName($tagName)) {
                $tag = Tag::create($tagName, $tagName);
                $this->tags->save($tag);
            }
            $product->assignTag($tag->id);
        }
        $this->products->save($product);

        return $product;
    }

    public function edit($id, ProductEditForm $form): void
    {
        $product = $this->products->get($id);
        $brand = $this->brands->get($form->brandId);
        $category = $this->categories->get($form->categories->main);

        $product->edit(
            $brand->id,
            $form->code,
            $form->name,
            $form->description,
            $form->is_new,
            $form->is_sale,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $product->changeCategory($category->id);

        $product->revokeTags();
        $this->products->save($product);


        foreach ($form->tags->existing as $tagId) {
            $tag = $this->tags->get($tagId);
            $product->assignTag($tag->id);
        }
        foreach ($form->tags->newNames as $tagName) {
            if (!$tag = $this->tags->findByName($tagName)) {
                $tag = Tag::create($tagName, $tagName);
                $this->tags->save($tag);
            }
            $product->assignTag($tag->id);
        }

        $this->products->save($product);
    }

    public function changePrice($id, PriceForm $form): void
    {
        $product = $this->products->get($id);
        $product->setPrice($form->new, $form->old);
        $this->products->save($product);
    }

    public function activate($id): void
    {
        $product = $this->products->get($id);
        $product->activate();
        $this->products->save($product);
    }

    public function draft($id): void
    {
        $product = $this->products->get($id);
        $product->draft();
        $this->products->save($product);
    }

    public function addPhoto($id, PhotoForm $form): void
    {
        $product = $this->products->get($id);
        $photo = Photo::create($form->image, $product->code);
        $photo->save();
        $product->setPhoto($photo->id);
        $this->products->save($product);
    }

    public function removePhoto($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->removePhoto($photoId);
        $this->products->save($product);
    }

    public function remove($id): void
    {
        $product = $this->products->get($id);
        $this->products->remove($product);
    }

    public function changeValues(int $id, CharacteristicsForm $form)
    {
        $product = $this->products->get($id);
        foreach ($form->values as $value) {
            $product->setValue($value->id, $value->value);
        }
    }

    public function makeSale($id)
    {
        $product = $this->products->get($id);
        $product->makeSale();
        $this->products->save($product);
    }

    public function makeNew($id)
    {
        $product = $this->products->get($id);
        $product->makeNew();
        $this->products->save($product);
    }

}