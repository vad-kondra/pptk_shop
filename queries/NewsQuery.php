<?php


namespace app\queries;


use yii\db\ActiveQuery;

class NewsQuery extends ActiveQuery
{

    public function public()
    {
        return $this->andWhere(['is_public' => true]);
    }

    public function orderByDate()
    {
        return $this->orderBy(['']);
    }

    public function onlyPublish()
    {
        return $this->andWhere(['<=', 'publish_at', time()]);
    }
}