<?php


namespace app\queries;


use yii\db\ActiveQuery;

class InformationQuery extends ActiveQuery
{

    public function public()
    {
        return $this->andWhere(['is_public' => true]);
    }

    public function orderByDate()
    {
        return $this->orderBy(['']);
    }
}