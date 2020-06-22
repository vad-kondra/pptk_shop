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
use app\repositories\productRepository\IProductRepository;
use app\repositories\TagRepository;

class ProductManageService
{
    private $_categoryRepository;
    private $_productRepository;
    private $_brandRepository;
    private $_tagRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        IProductRepository $productRepository,
        BrandRepository $brandRepository,
        TagRepository $tagRepository)
    {
        $this->_categoryRepository = $categoryRepository;
        $this->_productRepository = $productRepository;
        $this->_brandRepository = $brandRepository;
        $this->_tagRepository = $tagRepository;
    }

    public function create(ProductCreateForm $form): Product
    {
        $brand = $this->_brandRepository->get($form->brandId);
        $category = $this->_categoryRepository->get($form->categories->main);
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
            $tag = $this->_tagRepository->get($tagId);
            $product->assignTag($tag->id);
        }

        foreach ($form->tags->newNames as $tagName) {
            if (!$tag = $this->_tagRepository->findByName($tagName)) {
                $tag = Tag::create($tagName, $tagName);
                $this->_tagRepository->save($tag);
            }
            $product->assignTag($tag->id);
        }
        $this->_productRepository->save($product);

        return $product;
    }

    public function edit($id, ProductEditForm $form): void
    {
        $product = $this->_productRepository->get($id);
        $brand = $this->_brandRepository->get($form->brandId);
        $category = $this->_categoryRepository->get($form->categories->main);

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
        $this->_productRepository->save($product);


        foreach ($form->tags->existing as $tagId) {
            $tag = $this->_tagRepository->get($tagId);
            $product->assignTag($tag->id);
        }
        foreach ($form->tags->newNames as $tagName) {
            if (!$tag = $this->_tagRepository->findByName($tagName)) {
                $tag = Tag::create($tagName, $tagName);
                $this->_tagRepository->save($tag);
            }
            $product->assignTag($tag->id);
        }

        $this->_productRepository->save($product);
    }

    public function changePrice($id, PriceForm $form): void
    {
        $product = $this->_productRepository->get($id);
        $product->setPrice($form->new, $form->old);
        $this->_productRepository->save($product);
    }

    public function activate($id): void
    {
        $product = $this->_productRepository->get($id);
        $product->activate();
        $this->_productRepository->save($product);
    }

    public function draft($id): void
    {
        $product = $this->_productRepository->get($id);
        $product->draft();
        $this->_productRepository->save($product);
    }

    public function addPhoto($id, PhotoForm $form): void
    {
        $product = $this->_productRepository->get($id);
        $photo = Photo::create($form->image, $product->code);
        $photo->save();
        $product->setPhoto($photo->id);
        $this->_productRepository->save($product);
    }

    public function removePhoto($id, $photoId): void
    {
        $product = $this->_productRepository->get($id);
        $product->removePhoto($photoId);
        $this->_productRepository->save($product);
    }

    public function remove($id): void
    {
        $product = $this->_productRepository->get($id);
        $this->_productRepository->remove($product);
    }

    public function changeValues(int $id, CharacteristicsForm $form)
    {
        $product = $this->_productRepository->get($id);
        foreach ($form->values as $value) {
            $product->setValue($value->id, $value->value);
        }
    }

    public function makeSale($id)
    {
        $product = $this->_productRepository->get($id);
        $product->makeSale();
        $this->_productRepository->save($product);
    }

    public function makeNew($id)
    {
        $product = $this->_productRepository->get($id);
        $product->makeNew();
        $this->_productRepository->save($product);
    }

}