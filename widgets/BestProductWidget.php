<?php

namespace app\widgets;

use app\repositories\productRepository\ProductReadRepository;
use yii\base\Widget;
use yii\db\ActiveQuery;

/**
 * Class FeaturedProductsWidget
 * @package app\widgets
 * @property ActiveQuery $query
 * @property string[] $header
 */

class BestProductWidget extends Widget
{
    private $productRepository;

    public $query;
    public $header;

    public function __construct(ProductReadRepository $repository, $config = [])
    {
        $this->productRepository = $repository;
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();

        $this->query = $this->productRepository->getAllBestForCarusel();
        $this->header = 'Лучшие товары';

    }

    public function run()
    {
        if ($this->query->count() > 0) {

            return $this->render('best-product', [
                'header' => $this->header,
                'products' => $this->query->all()
            ]);
        }
        return '';
    }
}