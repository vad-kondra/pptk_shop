<?php

namespace app\widgets;

use app\repositories\productRepository\ProductReadRepository;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\db\ActiveQuery;

/**
 * Class FeaturedProductsWidget
 * @package app\widgets
 * @property ActiveQuery $queryBest
 * @property ActiveQuery $queryNew
 * @property ActiveQuery $querySale
 * @property string[] $headers
 */

class MainPageWidget extends Widget
{
    private $productRepository;

    public $queryBest;
    public $queryNew;
    public $querySale;

    public $headers;

    public function __construct(ProductReadRepository $repository, $config = [])
    {
        $this->productRepository = $repository;
        parent::__construct($config);
    }


    public function init()
    {
        parent::init();

        $this->queryBest = $this->productRepository->getAllBestForCarusel();
        $this->querySale = $this->productRepository->getAllSaleForCarusel();
        $this->queryNew = $this->productRepository->getAllNewForCarusel();


        if ($this->queryNew === null || $this->querySale === null) {
            throw new InvalidConfigException('The "query" property must be set.');
        }

        $this->headers = ['Лучшие товары', 'Новые поступления','Рекомендуемые'];

    }

    public function run()
    {
        if ($this->queryNew->count() > 0) {
            $queryBest = $this->queryBest->all();
            $queryNew = $this->queryNew->all();
            $querySale = $this->querySale->all();

            $headers = $this->headers;


            return $this->render('main-page', compact('headers', 'queryBest', 'queryNew', 'querySale'));
        }
        return '';
    }

}