<?php


namespace app\queries;


use yii\db\ActiveQuery;

class NewsQuery extends ActiveQuery
{

    public function public($alias = null)
    {
        return $this->andWhere(['is_public' => true]);
    }
}