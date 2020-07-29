<?php

namespace app\widgets;

use app\repositories\productRepository\ProductReadRepository;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\db\ActiveQuery;

/**
 * Class FeaturedProductsWidget
 * @package app\widgets
 * @property ActiveQuery $queryLatest
 * @property string[] $header
 */

class LatestProductWidget extends Widget
{
    private $productRepository;

    public $queryLatest;
    public $header;

    public function __construct(ProductReadRepository $repository, $config = [])
    {
        $this->productRepository = $repository;
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();

        $this->queryLatest = $this->productRepository->getAllNewForCarusel();

        if ($this->queryLatest === null) {
            throw new InvalidConfigException('The "query" property must be set.');
        }

        $this->header = 'Новые Поступления';
    }

    public function run()
    {
        if ($this->queryLatest->count() > 0) {

            return $this->render('sale-product', [
                'header' => $this->header,
                'products' => $this->queryLatest->all()
            ]);
        }
        return '';
    }

}