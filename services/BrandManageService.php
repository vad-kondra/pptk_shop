<?php


namespace app\services;


use app\models\Brand;
use app\models\BrandForm;
use app\models\Meta;
use app\repositories\BrandRepository;
use app\repositories\ProductRepository;

class BrandManageService
{
    private $brands;
    private $products;
    public function __construct(BrandRepository $brands, ProductRepository $products)
    {
        $this->brands = $brands;
        $this->products = $products;
    }
    public function create(BrandForm $form): Brand
    {
        $brand = Brand::create(
            $form->name,
            transliterate($form->name),
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->brands->save($brand);
        return $brand;
    }
    public function edit($id, BrandForm $form): void
    {
        $brand = $this->brands->get($id);
        $brand->edit(
            $form->name,
            transliterate($form->name),
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->brands->save($brand);
    }
    public function remove($id): void
    {
        $brand = $this->brands->get($id);
        if ($this->products->existsByBrand($brand->id)) {
            throw new \DomainException('Невозможно удалить производителя с товарами существующими в базе.');
        }
        $this->brands->remove($brand);
    }
}