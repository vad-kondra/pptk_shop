<?php


namespace app\widgets;


use app\models\Product;
use app\repositories\ProductReadRepository;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\db\ActiveQuery;

/**
 * Class FeaturedProductsWidget
 * @package app\widgets
 * @property ActiveQuery $queryNew
 * @property ActiveQuery $querySale
 * @property string[] $headers
 */

class CaruselProductsWidget extends Widget
{
    private $productRepository;

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

        $this->querySale = $this->productRepository->getAllSaleForCarusel();
        $this->queryNew = $this->productRepository->getAllNewForCarusel();


        if ($this->queryNew === null || $this->querySale === null) {
            throw new InvalidConfigException('The "query" property must be set.');
        }

        $this->headers = ['Новинки','Акция'];

    }

    public function run()
    {
        if ($this->queryNew->count() > 0) {
            $queryNew = $this->queryNew->all();
            $querySale = $this->querySale->all();

            $headers = $this->headers;


            return $this->render('carusel', compact('headers', 'queryNew', 'querySale'));
        }
        return '';
    }


}