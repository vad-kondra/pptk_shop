<?php

namespace app\widgets;

use app\repositories\productRepository\ProductReadRepository;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\db\ActiveQuery;

/**
 * Class FeaturedProductsWidget
 * @package app\widgets
 * @property ActiveQuery $querySale
 * @property string[] $header
 */

class SaleProductWidget extends Widget
{
    private $productRepository;

    public $querySale;
    public $header;

    public function __construct(ProductReadRepository $repository, $config = [])
    {
        $this->productRepository = $repository;
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();

        $this->querySale = $this->productRepository->getAllSaleForCarusel();

        if ($this->querySale === null) {
            throw new InvalidConfigException('The "query" property must be set.');
        }

        $this->header = 'Рекомендуемые';
    }

    public function run()
    {
        if ($this->querySale->count() > 0) {

            return $this->render('sale-product', [
                'header' => $this->header,
                'products' => $this->querySale->all()
            ]);
        }
        return '';
    }

}