<?php

namespace app\repositories;

use app\models\information\Information;

class InformationRepository
{
    public function getAllPublicTechArticles($limit = 3): array
    {
        return Information::find()
            ->public()
            ->orderBy(['created_at' => SORT_DESC])
            ->limit($limit)
            ->all();
    }

    public function getAllTechArticlesOrderByDate(): array
    {
        return Information::find()
            ->public()
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }

    public function getAll(): array
    {
        return Information::find()->all();
    }

    public function get($id): Information
    {
        if (!$informationArticles = Information::findOne($id)) {
            throw new NotFoundException('Новость не найдена.');
        }
        return $informationArticles;
    }

    public function save(Information $informationArticles): void
    {
        if (!$informationArticles->save()) {
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }

    public function remove(Information $informationArticles): void
    {
        if (!$informationArticles->delete()) {
            throw new \RuntimeException('Ошибка удаления.');
        }
    }
}