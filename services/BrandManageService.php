<?php
namespace app\services;

use app\models\Brand;
use app\models\BrandForm;
use app\models\Meta;
use app\repositories\BrandRepository;
use app\repositories\productRepository\IProductRepository;

class BrandManageService
{
    private $_brandRepository;
    private $_productRepository;

    public function __construct(
        BrandRepository $brands,
        IProductRepository $products)
    {
        $this->_brandRepository = $brands;
        $this->_productRepository = $products;
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
        $this->_brandRepository->save($brand);
        return $brand;
    }

    public function edit($id, BrandForm $form): void
    {
        $brand = $this->_brandRepository->get($id);
        $brand->edit(
            $form->name,
            transliterate($form->name),
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->_brandRepository->save($brand);
    }

    public function remove($id): void
    {
        $brand = $this->_brandRepository->get($id);
        if ($this->_productRepository->existsByBrand($brand->id)) {
            throw new \DomainException('Невозможно удалить производителя с товарами существующими в базе.');
        }
        $this->_brandRepository->remove($brand);
    }
}