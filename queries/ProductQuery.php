<?php


namespace app\queries;


use app\models\Product;
use yii\db\ActiveQuery;

class ProductQuery extends ActiveQuery
{
    /**
     * @param null $alias
     * @return $this
     */
    public function active($alias = null)
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'status' => Product::STATUS_ACTIVE,
        ]);
    }

    public function sale($alias = null)
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'is_sale' => true
        ]);
    }
    public function new($alias = null)
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'is_new' => true
        ]);
    }
    public function top($alias = null)
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'is_sale' => true //TODO change for rate
        ]);
    }

}