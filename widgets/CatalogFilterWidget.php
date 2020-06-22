<?php


namespace app\widgets;


use app\models\Product;
use yii\base\Widget;

/**
 * Class CatalogFilterWidget
 * @package app\widgets
 *
 * @property Product[] $products
 */

class CatalogFilterWidget extends Widget
{

    private $filters;

    public function init()
    {
        parent::init();


        $products = Product::find()->all();

        $values = [];
        $chars = [];
        foreach ($products as $product) {
            foreach ($product->values as $val) {
                $values[] = [$val->characteristic->name => $val->value] ;
                if (!in_array($val->characteristic->name, $chars)) {
                    $chars[] = $val->characteristic->name;
                }
            }
        }
        $this->filters = [];
        foreach ($chars as $char) {
            $this->filters[] = ['name' => $char, 'values' => array_column($values, $char)];
        }


    }

    public function run()
    {
        return $this->render('filter', [
            'filters' => $this->filters
        ]);
    }


}